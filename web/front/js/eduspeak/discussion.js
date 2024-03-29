<script>
    function uniqueToken() {
        var s4 = function () {
            return Math.floor(Math.random() * 0x10000).toString(16);
        };
        return s4() + s4() + "-" + s4() + "-" + s4() + "-" + s4() + "-" + s4() + s4() + s4();
    }
    var uniqueChannel = uniqueToken();
</script>

<script src="{{asset('front/js/eduspeak/RTCPeerConnection-v1.4.js')}}"></script>
<script src="{{asset('front/js/eduspeak/websocket.js')}}"></script>
<!-- First of all; get camera -->
<script>
    var socket;
	var pub = 'pub-c-43fee2d2-8fc4-4b00-b424-dd315210e2c2';
    var sub = 'sub-c-aca4aeda-be98-11e5-8408-0619f8945a4f';
    function openSocket() {
        socket = new WebSocket('wss://pubsub.pubnub.com/'+ pub +'/'+ sub +'/' + '4e551a32-309-cb13-74ff-37709250cda0');
        socket.onmessage = function (event) {
            console.log('message');
            var message = event.data;
            if (message.firstPart || message.secondPart || message.thirdPart) {
                if (message.firstPart) {
                    global.firstPart = message.firstPart;
                    if (global.secondPart && global.thirdPart) processReceievdSDP(message.by);
                }
                if (message.secondPart) {
                    global.secondPart = message.secondPart;
                    if (global.firstPart && global.thirdPart) processReceievdSDP(message.by);
                }
                if (message.thirdPart) {
                    global.thirdPart = message.thirdPart;
                    if (global.firstPart && global.secondPart) processReceievdSDP(message.by);
                }
            }
            if (message.candidate) {
                /* 2nd peer should process/add ice candidates sent by 1st peer! */
                if (message.by == 'peer1') {
                    peer2 && peer2.addICE({
                        sdpMLineIndex: message.sdpMLineIndex,
                        candidate: JSON.parse(message.candidate)
                    });
                }
                else {
                    peer1 && peer1.addICE({
                        sdpMLineIndex: message.sdpMLineIndex,
                        candidate: JSON.parse(message.candidate)
                    });
                }
            }
        };
        socket.onopen = function () {
            /* Socket opened; Now start creating offer sdp */
            create1stPeer();
        };
    }

	function processReceievdSDP(by)
	{
		if (by == 'peer1') {
			offerSDP = JSON.parse(global.firstPart + global.secondPart + global.thirdPart);
			setTimeout(create2ndPeer, 400);
		}

		/* 1st peer should complete the handshake using answer SDP provided by 2nd peer! */
		else peer1.addAnswerSDP(JSON.parse(global.firstPart + global.secondPart + global.thirdPart));
	}
    getUserMedia({
        video: document.getElementById('client-video'),
        onsuccess: function (stream) {
            clientStream = stream;
            openSocket();
        },
        onerror: function () {
            alert('Either you not allowed access to your microphone/webcam or another application already using it.');
        }
    });

    var clientStream;
    var global = {};
</script>

<!-- First peer: the offerer -->
<script>
    /* "offerSDP" will be used by your participant! */
    var offerSDP, peer1;
    function create1stPeer() {
        var offerConfig = {
            onOfferSDP: function (sdp) {
                console.log('1st peer: offer sdp: ' + sdp);
                /* Transmit offer SDP toward 2nd peer */
                sendsdp(sdp, 'peer1');
            },
            onICE: function (candidate) {
                console.log('1st peer: candidate' + candidate);
                socket.send({
                    by: 'peer1',
                    sdpMLineIndex: candidate.sdpMLineIndex,
                    candidate: JSON.stringify(candidate.candidate)
                });
            },
            onRemoteStream: function (stream) {
                console.log('1st peer: Wow! Got remote stream!');

				var video = document.getElementById('remote-video-1');
				if (!navigator.mozGetUserMedia) video.src = URL.createObjectURL(stream);
				else video.mozSrcObject = stream;
				video.play();
            },
            attachStream: clientStream
        };
        peer1 = RTCPeerConnection(offerConfig);
    }
</script>

<!-- Second peer: the participant -->
<script>
    var peer2;
    function  create2ndPeer() {
        var answerConfig = {
            onAnswerSDP: function (sdp) {
                console.log('2nd peer: sdp' + sdp);
                /* Transmit answer SDP toward 1st peer */
                sendsdp(sdp, 'peer2');
            },
            onICE: function (candidate) {
                console.log('2nd peer: candidate' + candidate);
                socket.send({
                    by: 'peer2',
                    sdpMLineIndex: candidate.sdpMLineIndex,
                    candidate: JSON.stringify(candidate.candidate)
                });
            },
            onRemoteStream: function (stream) {
                console.log('2nd peer: Wow! Got remote stream!');
                var video = document.getElementById('remote-video-2');
				if (!navigator.mozGetUserMedia) video.src = URL.createObjectURL(stream);
				else video.mozSrcObject = stream;
				video.play();
            },
            attachStream: clientStream,
            /* You'll use offer SDP here */
            offerSDP: offerSDP
        };
        peer2 = RTCPeerConnection(answerConfig);
    }
    function sendsdp(sdp, by) {
        sdp = JSON.stringify(sdp);
            var part = parseInt(sdp.length / 3);
            var firstPart = sdp.slice(0, part),
                secondPart = sdp.slice(part, sdp.length - 1),
                thirdPart = '';
            if (sdp.length > part + part) {
                secondPart = sdp.slice(part, part + part);
                thirdPart = sdp.slice(part + part, sdp.length);
            }
            socket.send({
                by: by,
                firstPart: firstPart
            });
            socket.send({
                by: by,
                secondPart: secondPart
            });
            socket.send({
                by: by,
                thirdPart: thirdPart
            });
    }
</script>
