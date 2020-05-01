// The purpose of the class is to get permissions from the customer to use his microphone and camera

export default class MediaHandler {
    getPermissions() {
        // Once the promise is resolved we'll have the mic and cam available for us
        return new Promise((res, rej) => {
            navigator.mediaDevices.getUserMedia({video: true, audio: true})
                .then((stream) => {
                    res(stream);
                })
                .catch(err => {
                    throw new Error(`No se ha podido obtener el stream ${err}`);
                    //Unable to fetch stream
                })
        });
    }
}