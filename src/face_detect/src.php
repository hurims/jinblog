<?genheader("가족 얼굴 인식", "May 18, 2024");?>
<p>
  ChatGPT의 도움으로 구현함.
</p>

  <script src="face-api.js"></script>
  <style>
    canvas {
      position: absolute;
      top: 0;
      left: 0;
    }
  </style>

  <video id="video" width="720" height="560" autoplay muted playsinline></video>
  <script>
    const video = document.getElementById('video');
    const familyMembers = ['jy', 'ji', 'jh', 'sh']; // 가족 구성원의 이름 리스트
    const displayNames = {'jy': '진영','ji': '지인','jh': '정훈','sh': '승훈'}

    async function startVideo() {
      const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
      video.srcObject = stream;
    }

    async function loadLabeledImages() {
      return Promise.all(
        familyMembers.map(async name => {
          const imgUrl = `./images/${name}.png`; // 가족 구성원의 이미지 경로
          const img = await faceapi.fetchImage(imgUrl);
          const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
          if (!detections) {
            throw new Error(`No faces detected for ${name}`);
          }
          const faceDescriptors = [detections.descriptor];
          return new faceapi.LabeledFaceDescriptors(displayNames[name], faceDescriptors);
        })
      );
    }

    function detect(labeledFaceDescriptors) {
      const canvas = faceapi.createCanvasFromMedia(video);
      document.body.append(canvas);
      const displaySize = { width: video.width, height: video.height };
      faceapi.matchDimensions(canvas, displaySize);

      const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);

      setInterval(async () => {
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors();
        const resizedDetections = faceapi.resizeResults(detections, displaySize);
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor));
        results.forEach((result, i) => {
          const box = resizedDetections[i].detection.box;
          const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() });
          drawBox.draw(canvas);
        });
      }, 100);
    }

    async function init() {
      await Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('/face_detect/models'),
        faceapi.nets.ssdMobilenetv1.loadFromUri('/face_detect/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/face_detect/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/face_detect/models')
      ]);

      const labeledFaceDescriptors = await loadLabeledImages();

      if (video.readyState >= 3) {
        detect(labeledFaceDescriptors);
      } else {
        video.addEventListener('play', () => {
            detect(labeledFaceDescriptors);
        });        
      }
    }

    startVideo();
    init();
  </script>
