import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MediaHandler from '../MediaHandler';
import Pusher from 'pusher-js';
import Peer from 'simple-peer';

const APP_KEY = '9e2cbb3bb69dab826cef';

let _PUBLIC_URL = location.href;
if(/public\//.test(location.href)) {
    let matches = location.href.match(/public\/(.+)/i);
    let place = location.href.search("/public/");

    if(place !== -1) {
        _PUBLIC_URL = location.href.substr(place, place+8);
    }
}

var URL= location.href.substr(0, location.href.indexOf('public')); 

export default class App extends Component {
    constructor(){
        super();
        // Creating local state. To know the Id of the other person
        this.state = {
            hasMedia: false,
            otherUserId: null
        };  

        this.users = [];
        this.users = window.allUsers;
        //console.log("allusers ",this.users);
        this.user = window.user;
        //console.log("user "+ window.user.id);
        // this.peer = {};
        this.peers = {};

        this.mediaHandler = new MediaHandler();
        this.setupPusher();

        this.callTo = this.callTo.bind(this);
        this.setupPusher = this.setupPusher.bind(this);
        this.startPeer = this.startPeer.bind(this);
        this.selectedUserId = null;
        // this.selectedUserId = this.users[0].id;
        // console.log('con this.selectedUserId',this.selectedUserId);
        this.incoming = false;
    }

    componentWillMount(){
        this.mediaHandler.getPermissions()
            .then((stream) => {
                this.setState({hasMedia: true});

                try{
                    // Because of depracation and browsers support
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

    incomingCall(signal){
        console.log("Hay una llamada entrante",signal); 
        let peer = this.peers[signal.userId];

        console.log("incomingCall peer",peer);
        console.log("peers on self and on userid",this.peers, this.peers[this.user.id]);
        

        // if peer doesn't already exists, we got an incoming call
        if(peer === undefined) {
            // The one that is calling us
            this.setState({otherUserId: signal.userId});
            console.log('He sido llamado por: ', signal.userId);
            // peer = this.startPeer(signal.userId, false);
            this.peers[signal.userId] = this.startPeer(signal.userId, false);
        } else{
            console.log("Full Signal, soy el que llama: ",signal);
        }

        // peer.signal(signal.data);
        this.peers[signal.userId].signal(signal.data);
    }
   
    // Pusher setup
    setupPusher() {
        // console.log("This User id: "+this.user.id);
       // console.log("Signal id: "+signal.userId);
        Pusher.logToConsole = true;
        this.pusher = new Pusher(APP_KEY, {
            // authEndpoint: 'https://localhost/esalud-app-web/public/pusher/auth',
            authEndpoint: URL+'public/pusher/auth',
            cluster: 'ap2',
            auth: { 
                // Auth object that will have to authorized
                params: this.user.id,
                headers: {
                    'X-CSRF-Token': window.csrfToken
                }
            }
        });

        // Instanc. channel. It requires auth before the user subscribes to the channel. All the data in the channel is persistant
        this.channel = this.pusher.subscribe('presence-video-channel');
        // Once the user is authorized dispatch calls can be made from the client side

        this.channel.bind(`client-signal-${this.user.id}`, (signal) => {
            // If a have a peer open (someone is calling me, as a response because I called him first):
            // Every time we create a peer we assign it to its userId
            console.log("Signal id aqui recibe: ",signal);
            
            if(signal.data.type=='offer'){
                showModalConfirm("Llamada entrante","¿Desea aceptar la llamada?",()=>{
                    this.incomingCall(signal);
                },()=>{
                    //TODO: Reset the call when cancel is pressed
                    location.reload();
                    // this.endCall(signal.userId);
                });
            }
            else if(signal.data.type=='answer'){
                this.incomingCall(signal);
            }
            
        });
    }

    startPeer(userId, initiator = true) {
        // Creating a peer
        const peer = new Peer({
            initiator, //of the call
            stream: this.user.stream, //our stream
            trickle: false
        });

        peer.on('signal', (data) => { // Getting data of someone that is sending us a signal
            console.log('peer signal',data);
            this.channel.trigger(`client-signal-${userId}`, { 
                //If someone is pinging us we send him a msg back on his channel
                type: 'signal',
                userId: this.user.id,
                data: data
            });
        });

        peer.on('stream', (stream) => { //Callback for user stream, the user video
            console.log("Recibe User Video",stream, this.peers);

            try {
                this.userVideo.srcObject = stream;
            } catch (e) {
                this.userVideo.src = URL.createObjectURL(stream); // for older browsers
            }

            try{
                this.userVideo.play();
            } catch (e) {
                console.error('user play error',e.message);
            }
        });


        peer.on('track', () => {
            console.log('new track arrived... ');  
        });
    
    
        peer.on('removestream', () => {
            //removeRemoteVideoElement(peerid); 
            console.log("stream removed... ");
        });

        peer.on('data', (data) => { 
            console.log('data: ' + data);
            console.log("DESTRUIDO!");
        });

        // peer.on('error', (err) => { 
        //     console.log('error', err);
        // });

        peer.on('connect', function () {
            $("#callButton").css("display", "none");
            $("#destroyButton").css("display", "inline");
            console.log('connect...');
        });

        peer.on('close', () => {
            console.log('close...');
            this.endCall(userId);

        });

        return peer;
    }

    selectUser(e){
        //console.log('selectUser',e);
        this.selectedUserId=e.target.value;
        //console.log('selectedUserId',this.selectedUserId);
        $("#callButton").css("display", "inline");
        $("#destroyButton").css("display", "none");
        
    }

    // Function to call other users
    callTo(userId) {
        this.peers[userId] = this.startPeer(userId); // Assigning the peer this userId
        console.log("peers userid: "+ userId);
        console.log("all kind of peers: ",this.peers);
        console.log("asigned peer: ",this.peers[userId]);
    }

    endCall(userId){
        console.log("cancel incomingCall peer: ",this.peers);

        // try{
        //     this.userVideo.srcObject = null;
        // } catch (e) {
        //     this.userVideo.src = URL.createObjectURL(null);
        // }

        // let peer = this.peers[userId];
        let peer = Object.values(this.peers)[0]

        if(peer !== undefined) {
            peer.destroy();
        }
        else{

        }
        this.peers[userId] = undefined;
        $("#destroyButton").css("display", "none");
        $("#callButton").css("display", "inline");


    }

    render() {
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

                <button id="destroyButton" className="btn btn-danger" 
                onClick={ () => this.endCall(this.selectedUserId)}><i className="fas fa-phone-slash"></i>&ensp;End call</button>

                {/*[1,2,3,4].map((userId) => {
                    return this.user.id !== userId ? <button key={userId} onClick={() => this.callTo(userId)}>Call {userId}</button> : null;
                })*/} 

                {/* Video for the caller and the reciever */}
                <div className="video_container">
                    <video className="my_video" ref={(ref) => {this.myVideo = ref;}}></video>
                    <video className="user_video" ref={(ref) => {this.userVideo = ref;}}></video>
                </div>

            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
