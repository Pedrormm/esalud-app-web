import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MediaHandler from '../MediaHandler';
import customControls from '../ControlsHandler';
import * as utils from '../VideoUtils';
import Pusher from 'pusher-js';
import Peer from 'simple-peer';
import queryString from 'query-string';

const APP_KEY = '9e2cbb3bb69dab826cef';
function getQueryVariable(variable)
{
        var query = window.location.search.substring(1);
        // console.log(query)//"app=article&act=news_content&aid=160990"
        var vars = query.split("&");
        // console.log(vars) //[ 'app=article', 'act=news_content', 'aid=160990' ]
        for (var i=0;i<vars.length;i++) {
                    var pair = vars[i].split("=");
                    // console.log(pair)//[ 'app', 'article' ][ 'act', 'news_content' ][ 'aid', '160990' ] 
        if(pair[0] == variable){return pair[1];}
         }
         return(false);
}
export default class AppVideoRoom extends Component {
    constructor(props){
        super(props);
        let userId = getQueryVariable('userId');
        console.log(userId);
        this.user = window.user;
        console.log("usuario ",this.user);

        this.peers[userId] = this.startPeer(userId); // Assigning the peer this userId


        // Creating local state. To know the Id of the other person and mode
        this.state = {
            hasMedia: false,
            otherUserId: null,
            // mode: props.mode ? props.mode :'hold'
            mode: utils.isInVideoCallView() || isABootstrapModalOpen()  ? props.mode :'receive'
        };  
        console.log(window.location.href);

        //console.log("allusers ",this.users);
        // this.user = window.user;


        // console.log("user ", window.user);
        // this.peer = {};
        this.peers = {};

        this.signalSent = window.signalSent;
        console.log("signalSent: ", this.signalSent);

        this.loadedReceptorURL = (this.signalSent == "#") || (this.signalSent == null) ? false :true;

        console.log("loadedReceptorURL:",this.loadedReceptorURL)


        this.mediaHandler = new MediaHandler();
        // this.setupPusher();


        this.callTo = this.callTo.bind(this);
        this.setupPusher = this.setupPusher.bind(this);
        this.startPeer = this.startPeer.bind(this);
        this.selectedUserId = null;
        // this.selectedUserId = this.users[0].id;
        // console.log('con this.selectedUserId',this.selectedUserId);
        this.incoming = false;
        this.isFullScreen = false;
        this.incomingCall = this.incomingCall.bind(this);
        this.endCall = this.endCall.bind(this);
        this.fullScreen = this.fullScreen.bind(this);
        this.audioVideoPermissions = this.audioVideoPermissions.bind(this);

        this.handleFullScreen = this.handleFullScreen.bind(this);
        // this.isABootstrapModalOpen = this.isABootstrapModalOpen.bind(this);

        // this.backupPeer;

        console.log("MODAL: ", isABootstrapModalOpen());
        console.log("ending constructor all kind of peers: ",this.peers);

        this.globalStream = null;
        this.globalTrack = null;

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

    componentDidMount(){
        console.log("componentDidMount all kind of peers: ",this.peers);
        
        // if(this.state.mode=='call'){

            this.audioVideoPermissions();

            document.addEventListener('fullscreenchange', this.handleFullScreen, false);
            document.addEventListener('webkitfullscreenchange', this.handleFullScreen, false);
            document.addEventListener('mozfullscreenchange', this.handleFullScreen, false);
            document.addEventListener('MSFullscreenChange', this.handleFullScreen, false);

            $(function() {
                if (utils.isInVideoCallView()){
                    customControls()
                }
            });           
            
            if (this.loadedReceptorURL){
                console.log("loadedReceptorURL!!");
                // setTimeout(function() {
                    console.log("---+ LOADED!!!!!!!!! +---");
    
                    // console.log("Hay una llamada entrante con this.peers",this.peers); 
                    // let peer = this.peers[this.signalSent.userId];
    
                    // console.log("incomingCall peer",peer);
                    // console.log("peers on self and on userid",this.peers, this.peers[this.user.id]);
                    
    
                    // // if peer doesn't already exists, we got an incoming call
                    // if(peer === undefined) {
                        // The one that is calling us
                        this.setState({otherUserId: this.signalSent.userId});
                        console.log('He sido llamado por: ', this.signalSent.userId);
                        // peer = this.startPeer(this.signalSent.userId, false);
                        let peer = this.startPeer(this.signalSent.userId, false);

                        // this.peers[signalSent.userId] = this.startPeer(signalSent.userId, false);
                    // } else{
                    //     console.log("Full signalSent, soy el que llama: ",signalSent);
                    // }

                    console.log("mi data es: ",this.signalSent.data);
                    peer.signal(this.signalSent.data);
                    // this.peers[signalSent.userId].this.signalSent(signalSent.data);
    
                // }, 5000);
            }
        // }
    }

    componentWillUnmount() {
        // document.removeEventListener('fullscreenchange', this.handleFullScreen, false);
        // document.removeEventListener('webkitfullscreenchange', this.handleFullScreen, false);
        // document.removeEventListener('mozfullscreenchange', this.handleFullScreen, false);
        // document.removeEventListener('MSFullscreenChange', this.handleFullScreen, false);

      }

    handleFullScreen(e) {
        if (document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement !== null)
        {
            console.log('EVENTO VENTANA! '); 
            $(".user_video")[0].webkitExitFullscreen();


            var state = document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen;
            var event = state ? 'FullscreenOn' : 'FullscreenOff';  

        }

    }

    incomingCall(signal){
        console.log("Hay una llamada entrante",signal); 
        console.log("Hay una llamada entrante con this.peers",this.peers); 

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
            console.log("****** after asigning peers to startPeer ",this.peers);
            // this.backupPeer = this.peers[signal.userId];
        } else{
            console.log("Full Signal, soy el que llama: ",signal);
        }

        // peer.signal(signal.data);
        console.log("mi data es: ",signal.data);
        this.peers[signal.userId].signal(signal.data);
    }
   
    // Pusher setup
    setupPusher() {
        console.log("setup pusher");
        // console.log("This User id: "+this.user.id);
       // console.log("Signal id: "+signal.userId);
        Pusher.logToConsole = false;
        this.pusher = new Pusher(APP_KEY, {
            // authEndpoint: 'https://localhost/esalud-app-web/public/pusher/auth',
            authEndpoint: _publicUrl+'pusher/auth',
            cluster: 'ap2',
            auth: { 
                // Auth object that will have to authorized
                headers: {
                    'X-CSRF-Token': window.csrfToken
                },
                params: this.user.id,
            }
        });

        // Instanc. channel. It requires auth before the user subscribes to the channel. All the data in the channel is persistant
        this.channel = this.pusher.subscribe('presence-video-channel');
        // Once the user is authorized dispatch calls can be made from the client side


        let peerBackup = Object.values(this.peers)[0]
        let peersBackup = this.peers;

        this.channel.bind(`client-signal-${this.user.id}`, (signal) => {
            // If a have a peer open (someone is calling me, as a response because I called him first):
            // Every time we create a peer we assign it to its userId
            console.log("Signal id aqui recibe: ",signal);
                if(signal.data.type=='offer'){
                    let whoCalls="";

                    $.ajax(_publicUrl + 'videoCall/getUserInfo', {
                        dataType: "text",
                        data: {id: signal.userId},
                        method:'get',
                        async: false,
                    }).done(function(res){
                        whoCalls = res;
                    })
                    .fail(function(xhr, st, err) {
                        console.error("error in videoCall/getUserInfo " + xhr, st, err);
                    });

                    if (!utils.isInVideoCallView()){
                        
                        showModalConfirm(_messagesLocalization.incoming_call_coming_from + " "+whoCalls,_messagesLocalization.would_you_like_to_accept_the_call,()=>{
                            // window.location.replace(_publicUrl+'videoCall/'+JSON.stringify(signal));
                            $('#saveModal').off('click');
                            console.log("NO EN VENTANA VIDEO");

                            $("#video-modal").modal("show");

                            $('#video-modal .modalCollapse').show();
                            $("#video-modal .modal-body").collapse('show');

                            $("#video-modal .modalCollapse").click(function(){
                                $('#video-modal .modal-body').collapse('toggle');
                                let icon = this.querySelector('i');
                        
                                $('#video-modal .modal-body').on('hidden.bs.collapse', function () {
                                    icon.classList.remove('fa-caret-square-down');
                                    icon.classList.add('fa-caret-square-right');
                                });
                                $('#video-modal .modal-body').on('shown.bs.collapse', function () {
                                    icon.classList.remove('fa-caret-square-right');
                                    icon.classList.add('fa-caret-square-down');
                                }); 
                            
                                return;
                            });

                            $('#video-modal').on('hidden.bs.modal', function () {
                                // location.reload();
                            });

                            this.incomingCall(signal);
                        },()=>{
                            //TODO: Reset the call when cancel is pressed
                            this.endCall(signal.userId);
                        });


                    }
                    else{
                        console.log("EN VENTANA VIDEO");
                        // this.usersIds[signal.userId]
                        showModalConfirm(_messagesLocalization.incoming_call_coming_from + " "+whoCalls,_messagesLocalization.would_you_like_to_accept_the_call,()=>{
                            this.incomingCall(signal);
                        },()=>{
                            // Reset the call when cancel is pressed
                            // window.history.pushState('Cancel', 'Cancel', _publicUrl + 'records');
                            // window.history.forward();
                            // location.reload();
                            // this.forceUpdate();
                            // $(".app").load(location.href + " #video_container>*"); 
                            this.endCall(signal.userId);
                        });
                    }   
                }
                else if(signal.data.type=='answer'){
                    this.incomingCall(signal);
                }
                else if(signal.data.type=='close'){
                    console.log(signal.userId);
                    this.endCall(signal.userId);
                }
                else{
                    console.log("Tipo de llamada no reconocida");
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
            this.globalStream = stream;

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

        peer.on('track', (track, stream) => {
            this.globalTrack = track;
            console.log('new track arrived... ', track, stream);  
        });
    
        peer.on('removestream', () => {
            //removeRemoteVideoElement(peerid); 
            console.log("stream removed... ");
        });

        peer.on('data', (data) => { 
            console.log('data: ' + data);
            // console.log("DESTRUIDO!");
        });

        // peer.on('error', (err) => { 
        //     console.log('error ', err);
        // });

        peer.on('connect', function () {
            $("#callButton").css("display", "none");
            $("#destroyButton").css("display", "inline");
            if (utils.isInVideoCallView()){
                $(".video-controls").css("display", "block");
            }
            else{
                $(".user_video").prop("controls",true);
                $(".user_video").prop("webkitAllowFullScreen",true); 
                $(".user_video").prop("mozAllowFullScreen",true); 
                $(".user_video").prop("allowFullScreen",true); 
            }
            console.log('connect...');

        });

        peer.on('close', () => {
            console.log('close...');
            if (this.peers[Object.values(this.peers)[0]] !== undefined)
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
        // this.backupPeer = this.peers[userId];
        console.log("peers userid: "+ userId);
        console.log("all kind of peers: ",this.peers);
        console.log("asigned peer: ",this.peers[userId]);
        // this.audioVideoPermissions();
    }

    endCall(userId){
        // if (!utils.isInVideoCallView()){
        //     $("#video-modal").modal("hide");
        // }
        // location.reload();

        console.log("cancel incomingCall peer: ",this.peers);

        this.userVideo.pause();
        try{
            this.userVideo.srcObject = null;
        } catch (e) {
            this.userVideo.src = URL.createObjectURL(null);
        }

        // let peer = this.peers[userId];
        let peer = Object.values(this.peers)[0];
        let peerKey = Object.keys(this.peers)[0];

        if(peerKey !== undefined) {
        //    peer.destroy();
            // peer.removeTrack(this.globalTrack);
            // peer.removeStream(this.globalStream);
            // peer.removeTrack(this.globalStream.getAudioTracks()[0], stream);

            if (this.user.id == userId){
                this.channel.trigger(`client-signal-${peerKey}`, { 
                    type: 'close',
                    userId: this.user.id,
                    data: {type:'close'}
                });
            }

            // console.log("****************BackupPeer", this.backupPeer);
            console.log("peerkey vs userId:", peerKey, userId);
            console.log("****** before destroy",this.peers[peerKey]);
            // this.peers[peerKey].signal("Close");
            this.peers[peerKey].destroy();
            // delete this.peers[userId];
            console.log("****** after destroy",this.peers[peerKey]);
            //this.peers[userId] = this.startPeer(userId);
            // this.peers[userId] = this.backupPeer;
            console.log("****** after startPeer",this.peers[userId]);
            this.peers[peerKey] = undefined;
            // setTimeout(function() {            
  
            // }, 50);
            console.log("****** after undefined",this.peers);
            // this.peers = {};

            // document.querySelector('#userVideo').remove();
            
            // let newVideo = document.createElement("video");
            // newVideo.className = "user_video";
            // newVideo.id = "userVideo";

            // $(newVideo).insertAfter("#myVideo");
            // this.userVideo = newVideo;

            // this.audioVideoPermissions();
            
        }
        else{

        }
        //this.peers[userId] = undefined;
        // peer = peerBackup;
        // this.peers = peersBackup;
        // this.peers = {};

        $("#destroyButton").css("display", "none");
        $("#callButton").css("display", "inline");
        $(".video-controls").css("display", "none");

        // peerBackup = $(peer).extends(true);
        // peerBackup = peer;
        // peer = peerBackup;

    }


    fullScreen()
    {
        var isInFullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
        (document.webkitFullscreenElement && document.webkitFullscreenElement !== null) ||
        (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
        (document.msFullscreenElement && document.msFullscreenElement !== null);

        var targetelement = document.getElementById("video_container");  

        if (!isInFullScreen) {
            if (targetelement.requestFullscreen)
            {
                targetelement.requestFullscreen();
            } 	  
            if (targetelement.webkitRequestFullscreen)
            {
                targetelement.webkitRequestFullscreen();
            }
            if (targetelement.mozRequestFullScreen)
            {
                targetelement.mozRequestFullScreen();
            }
            if (targetelement.msRequestFullscreen)
            {
                targetelement.msRequestFullscreen();
            }
        }
        else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    }

 
    render() {
        const mode = this.state.mode;
                return (
                <div className="app">

                    <button id="destroyButton" className="btn btn-danger" 
                    onClick={ () => this.endCall(this.user.id)}><i className="fas fa-phone-slash"></i>&ensp;End call</button>

                    {/* Video for the caller and the reciever */}
                    <div id="video_container">
                        <video muted className="my_video" id="myVideo"
                        ref={(ref) => {this.myVideo = ref;}}></video>
                        <video className="user_video" id="userVideo"
                        ref={(ref) => {this.userVideo = ref;}}></video>

                        <div className="video-controls">
                            <div className="video-playback-controls">
                                <button className="control-btn toggle-play-pause pause">
                                    <i className="fas fa-play play-icon icon"></i>
                                    <i className="fas fa-pause pause-icon icon"></i>
                                </button>
                                <div className="video-volume-control">
                                    <button className="control-btn toggle-volume on">
                                        <i className="fas fa-volume-up icon volume-on"></i>
                                        <i className="fas fa-volume-mute icon volume-off"></i>
                                    </button>
                                    <input type="range" id="volume-bar" min="0" max="1" step="0.1" defaultValue="1"/>
                                </div>
                                <div className="video-right-side">
                                    <div className="start-time time">00:00:00</div>
                                    <button id="fScreen" onClick={ () => this.fullScreen()}>                                   
                                        <div className="control-btn">
                                            <i className="fas fa-compress icon"></i>
                                            {/* <img src={ URL+"images/fullScreenIcon.png"}></img> */}
                                        </div>
                                    </button>
                                </div>                                
                            </div>
                        </div>

                    </div>
                </div>
            );
        
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<AppVideoRoom />, document.getElementById('app'));
}

