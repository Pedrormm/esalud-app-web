import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MediaHandler from '../MediaHandler';
import customControls from '../ControlsHandler';
import * as utils from '../VideoUtils';
import Pusher from 'pusher-js';
var hash = require('object-hash');


const APP_KEY = '9e2cbb3bb69dab826cef';

    // Opera 8.0+
    const isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    
    // Firefox 1.0+
    const isFirefox = typeof InstallTrigger !== 'undefined';
    
    // Safari 3.0+ "[object HTMLElementConstructor]" 
    const isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
    
    // Internet Explorer 6-11
    const isIE = /*@cc_on!@*/false || !!document.documentMode;
    
    // Edge 20+
    const isEdge = !isIE && !!window.StyleMedia;
    
    // Chrome 1 - 71
    const isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
    
    // Blink engine detection
    const isBlink = (isChrome || isOpera) && !!window.CSS;

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
            $.ajax(_publicUrl + 'videoCall/getUserInfo', {
                dataType: "text",
                data: {id: userId},
                method:'get',
                async: false,
            }).done(function(res){
                userReceiverFullName = res;
            })
            .fail(function(xhr, st, err) {
                console.error("error in videoCall/getUserInfo " + xhr, st, err);
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
            $('#videoFormData').remove();
            $('#sessionName').val(session);
            let hiddenForm = $('<form>', {id: 'videoFormData', method: 'post', action: _publicUrl+'videoCallContainer', target: 'videoWindow'});
            hiddenForm.append($('<input>', {type: 'hidden', name:'userFullName', value: authUser.name + " " + authUser.lastname}));
            hiddenForm.append($('<input>', {type: 'hidden', name:'sessionName', id:'sessionName', value: session}));
            $('body').append(hiddenForm);
            $('#sessionName').val(session);
            console.log(session);
            console.log($('#sessionName').val());

            // $.ajax(_publicUrl + 'videoCallContainer', {
            //     dataType: "text",
            //     data: {sessionName: session, userName: authUser.name + " " + authUser.lastname},
            //     method:'post',
            //     target: 'videoWindow',
            // }).done(function(res){
            //     console.log(session);
    
            //     let openviduWindow = window.open('', 'videoWindow');
            // })
            // .fail(function(xhr, st, err) {
            //     console.error("error in videoCall/getUserInfo " + xhr, st, err);
            // });


    
            // console.log(session);
    
            let openviduWindow = window.open('', 'videoWindow');
            // let that = this;
            // openviduWindow.onunload= function() { 
            //     console.log("Cerró la llamada");
            //     that.state.latestSession = null;
            // };


            $('#videoFormData').submit();
            $('#videoFormData').remove();
            // window.open(_publicUrl+"videoCallContainer?userId="+userId+"&sessionName="+session,"blank");    
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
            $.ajax(_publicUrl + 'videoCall/getUserInfo', {
                dataType: "text",
                data: {id: userId},
                method:'get',
                async: false,
            }).done(function(res){
                userReceiverFullName = res;
                console.log("name ",userReceiverFullName);
            })
            .fail(function(xhr, st, err) {
                console.error("error in videoCall/getUserInfo " + xhr, st, err);
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
                console.log('users:', this.users)
                return (
                <div className="app">
                    <select className={isFirefox ?"selectUserToCall":"selectpicker selectUserToCall"} data-live-search="true" data-style="btn-info"
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

