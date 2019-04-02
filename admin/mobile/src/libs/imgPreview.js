export const imgPreview = (file)=>{
    return new Promise(function (resolve, reject) {
        if (!file || !window.FileReader) return;
        if (/^image/.test(file.type)) {
            // 创建一个reader
            let reader = new FileReader();
            // 将图片2将转成 base64 格式
            reader.readAsDataURL(file);
            // 读取成功后的回调
            reader.onloadend = function () {
                let result = this.result;
                let img = new Image();
                img.src = result;
                //判断图片是否大于100K,是就直接上传，反之压缩图片
                if (this.result.length <= (120 * 1024)) {
                    resolve(file)
                } else {
                    img.onload = function () {
                        let src = compress(img);
                        let file = dataURItoBlob(src);
                        resolve(file)
                    }
                }
            }
        }
    })

}

function compress(img) {
    let canvas = document.createElement("canvas");
    let ctx = canvas.getContext('2d');
    //瓦片canvas
    let tCanvas = document.createElement("canvas");
    let tctx = tCanvas.getContext("2d");
    let width = img.width;
    let height = img.height;
    //如果图片大于四百万像素，计算压缩比并将大小压至400万以下
    let ratio;
    if ((ratio = width * height / 4000000) > 1) {
        ratio = Math.sqrt(ratio);
        width /= ratio;
        height /= ratio;
    } else {
        ratio = 1;
    }
    canvas.width = width;
    canvas.height = height;
//        铺底色
    ctx.fillStyle = "#fff";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    //如果图片像素大于100万则使用瓦片绘制
    let count;
    if ((count = width * height / 1000000) > 1) {
        count = ~~(Math.sqrt(count) + 1); //计算要分成多少块瓦片
//            计算每块瓦片的宽和高
        let nw = ~~(width / count);
        let nh = ~~(height / count);
        tCanvas.width = nw;
        tCanvas.height = nh;
        for (let i = 0; i < count; i++) {
            for (let j = 0; j < count; j++) {
                tctx.drawImage(img, i * nw * ratio, j * nh * ratio, nw * ratio, nh * ratio, 0, 0, nw, nh);
                ctx.drawImage(tCanvas, i * nw, j * nh, nw, nh);
            }
        }
    } else {
        ctx.drawImage(img, 0, 0, width, height);
    }
    //进行最小压缩
    let ndata = canvas.toDataURL('image/jpeg', 0.3);
    tCanvas.width = tCanvas.height = canvas.width = canvas.height = 0;
    return ndata;
}

function dataURItoBlob(base64Data) {
    var byteString;
    if (base64Data.split(",")[0].indexOf("base64") >= 0)
        byteString = atob(base64Data.split(",")[1]);
    else byteString = unescape(base64Data.split(",")[1]);
    var mimeString = base64Data
        .split(",")[0]
        .split(":")[1]
        .split(";")[0];
    var ia = new Uint8Array(byteString.length);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ia], {type: mimeString});
}
