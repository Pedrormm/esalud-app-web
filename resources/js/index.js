import React from 'react';
import ReactDOM from 'react-dom';
import VideoRoomComponent from './components/VideoRoomComponent';
import registerServiceWorker from './registerServiceWorker';

// let params = new URLSearchParams(location.search);

// let userFullName = params.get('userFullName');
// let sessionName = params.get('sessionName');

// let userFullName = window.userData.userFullName;
// let sessionName = window.userData.sessionName;

let appElement = document.getElementById('app');
let props = Object.assign({}, appElement.dataset);

let dynamicProps = {
    sessionName: props.sessionname,
    user: props.userfullname, 
    openviduServerUrl:"https://localhost:4443"
}

ReactDOM.render(<VideoRoomComponent {...dynamicProps} />, document.getElementById('app'));
registerServiceWorker();
