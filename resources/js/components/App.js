import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MediaHandler from '../MediaHandler';
import customControls from '../ControlsHandler';
import * as utils from '../VideoUtils';
import Pusher from 'pusher-js';
var hash = require('object-hash');


const APP_KEY = '9e2cbb3bb69dab826cef';

export default class App extends Component {
    constructor(props){
        super(props);
        // Creating local state. To know the Id of the other person and mode
        this.state = {
            hasMedia: false,
            otherUserId: null,
            latestSession: null,
            // mode: props.mode ? props.mode :'hold'
            mode: utils.isInVideoCallView() || isABootstrapModalOpen()  ? props.mode :'receive'
        };  

        this.users = window.allUsers;
        this.user = window.user;

        this.mediaHandler = new MediaHandler();

        this.callTo = this.callTo.bind(this);
        this.selectedUserId = null;

        this.audioVideoPermissions = this.audioVideoPermissions.bind(this);

    }

    audioVideoPermissions(){
        console.log("audioVideoPermissions");
        this.mediaHandler.getPermissions()
            .then((stream) => {
                this.setState({hasMedia: true});
                try{
                    // Because of depracation and browsers support
                    console.log("stream ", stream)
                    this.user.stream = stream;
                    this.myVideo.srcObject = stream;
                } catch (e) {
                    // Assigning source of my video the URL of the stream to have a source available
                    this.myVideo.src = URL.createObjectURL(stream);
                }
                try{
                    this.myVideo.play();
                } catch (e) {
                    console.error('user play error',e.message);
                }
            })
    }


    selectUser(e){
        //console.log('selectUser',e);
        this.selectedUserId=e.target.value;
        //console.log('selectedUserId',this.selectedUserId);
        $("#callButton").css("display", "inline");
        // $("#destroyButton").css("display", "none");
        
    }

    setupVideoPusher() {
    
    
    }
    // Function to call other users
    callTo(userId) {
        
        let session = hash(new Date().getTime(), {algorithm: 'md5'});
            $('#content').data('session-video-call', session);

        this.state.latestSession = session;    

        let pusher = videoPusherInit();
        let videoChannel = pusher[1];
        console.log(videoChannel);

        videoChannel.bind('pusher:subscription_succeeded', function() {
            let userReceiverFullName ="";
            $.ajax(PublicURL + 'video/getUserInfo', {
                dataType: "text",
                data: {id: userId},
                method:'get',
                async: false,
            }).done(function(res){
                userReceiverFullName = res;
            })
            .fail(function(xhr, st, err) {
                console.error("error in video/getUserInfo " + xhr, st, err);
            });

            videoChannel.trigger(`client-video-channel-send`, { 
                session:session,
                userReceiverId: Number(userId),
                userReceiverFullName: userReceiverFullName,
                userCallerId: Number(authUser.id),
                userCallerFullName: authUser.name + " " + authUser.lastname
            });

            console.log(userReceiverFullName, authUser.name + " " + authUser.lastname);

            console.log("hiddenform");
            let hiddenForm = $('<form>', {id: 'videoFormData', method: 'post', action: PublicURL+'user/video-call-container', target: 'videoWindow'});
            hiddenForm.append($('<input>', {type: 'hidden', name:'userFullName', value: authUser.name + " " + authUser.lastname}));
            hiddenForm.append($('<input>', {type: 'hidden', name:'sessionName', value: session}));
            $('body').append(hiddenForm);
    
            console.log(session);
    
            let openviduWindow = window.open('', 'videoWindow');
            // let that = this;
            // openviduWindow.onunload= function() { 
            //     console.log("Cerró la llamada");
            //     that.state.latestSession = null;
            // };


            $('#videoFormData').submit();
    
            // window.open(PublicURL+"user/video-call-container?userId="+userId+"&sessionName="+session,"blank");    
            // if (this.state.latestSession !== null ){
                $("#joinButton").css("display", "inline");
            // }
        });
        
    }

    inviteTo(userId) {

        let pusher = videoPusherInit();
        let videoChannel = pusher[1];
        console.log("invite ",videoChannel);
        let that = this;

        videoChannel.bind('pusher:subscription_succeeded', function() {
            let userReceiverFullName ="";
            $.ajax(PublicURL + 'video/getUserInfo', {
                dataType: "text",
                data: {id: userId},
                method:'get',
                async: false,
            }).done(function(res){
                userReceiverFullName = res;
                console.log("name ",userReceiverFullName);
            })
            .fail(function(xhr, st, err) {
                console.error("error in video/getUserInfo " + xhr, st, err);
            });

            videoChannel.trigger(`client-video-channel-send`, { 
                session:that.state.latestSession,
                userReceiverId: Number(userId),
                userReceiverFullName: userReceiverFullName,
                userCallerId: Number(authUser.id),
                userCallerFullName: authUser.name + " " + authUser.lastname
            });
        });
    }

    inviteToButton(lastSession) {

        if (lastSession!==null){
            return (
                <button id="joinButton" className="btn btn-primary" 
                onClick={ () => this.inviteTo(this.selectedUserId)}><i className="fa fa-share-alt"></i>&ensp;Invite</button>
            );
        }
    }
 
    render() {
        const mode = this.state.mode;
        if(mode=='call'){
                return (
                <div className="app">
                    <select className="selectpicker selectUserToCall" data-live-search="true" data-style="btn-info"
                    title="Busque usuario por nombre, apellidos o dni" data-width="35%"       
                    data-header="Busque usuario por nombre, apellidos o dni" onChange={(e) => this.selectUser(e)}>
                        {Object.keys(this.users).map((role, roleId) => {                      
                            return (
                                <optgroup key={ roleId } label={ role }>
                                {
                                    Object.keys(this.users[role]).map(u => {
                                    return (                               
                                        this.users[role][u].id !== user.id ?
                                        <option data-subtext={this.users[role][u].dni} key={`${u}-${role}.id`} value={this.users[role][u].id}>
                                        {this.users[role][u].name} {this.users[role][u].lastname}</option> : null                             
                                    );
                                    })
                                }
                                </optgroup>
                            );                                        
                        })}
                    </select> 

                    <button id="callButton" className="btn btn-primary" 
                    onClick={ () => this.callTo(this.selectedUserId)}><i className="fa fa-phone"></i>&ensp;Call</button>

                    { this.inviteToButton(this.state.lastSession) }

                </div>
            );
        }
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App mode='call' />, document.getElementById('app'));
}

