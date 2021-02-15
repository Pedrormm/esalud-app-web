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

// let serverUrl = "https://localhost:4443";
// if(/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/.test(location.href)) {
//     serverUrl = "https://188.76.18.9:5657";
// }
// https://188.76.18.87:1350
// "https://localhost:4443"
// https://192.168.1.10:4443
// https://34.74.14.170/#/dashboard
// https://82.223.128.221
//  


let dynamicProps = {
    sessionName: props.sessionname,
    // sessionName: "sessionA",
    user: props.userfullname, 
    openviduServerUrl:"https://www.mihospitalvirtual.com:4443",
    openviduSecret:"1234"
}

console.log("dynamicProps",dynamicProps);   
console.log("sessionName ",dynamicProps.sessionName);   


ReactDOM.render(<VideoRoomComponent {...dynamicProps} />, document.getElementById('app'));
registerServiceWorker();
