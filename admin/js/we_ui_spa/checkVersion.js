/*
站内登录
 */
// (function(){
// 101旗舰店，100开放平台管理员,9老大,8系统管理员
var app = {
    version: 1.01         // 系统版本好，用于自动升级
}
// 从缓存中获取用户，加快加载
//var user = localStorage.user_universal ? JSON.parse(localStorage.user_universal) : {id: 0, role: 0};

// 检查用户权限 & 系统更新
function checkUser() {
    $.getJSON('admin/checkUser.php', {userid: user.id}, function (json) {
        if (json.version > app.version) {
            window.location.reload(true); // 系统升级, 强制刷新缓存
        } else if ( user.role != json.role ) {
            localStorage.user_universal = JSON.stringify(json);
            window.location.reload();
        }
    });
}
    setTimeout(checkUser, 500);


// })();
