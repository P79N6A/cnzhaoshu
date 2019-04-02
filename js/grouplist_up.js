var users_count = 0;
var users_total = 0;

function addUserList() {
	var groupid = window.platform ? platform : union;
	
	if (groupid) {
		$.getJSON('/com/getgroupusers.php',{platformid:groupid},function (json) {
			// if (!json) return;

			users = json ? json : [];

			var html = '<div class="title"> <br><i>' + users.length +'家会员单位</i></div>';
			// var html = '';
			var renzhenghtml = isPc ? '<span class="renzheng">已认证</span>' : '<a class="renzheng" href="renzheng.php">已认证</a>';
			var qjdhtml = '<span class="qjd">已认证</span>';

			if (isPc) html += '<ul>';

			for (var i = 0; i < users.length; i++) {
				var user = users[i];
				users_count += user.count;
				users_total += user.total;
				
				var renzheng = user.userisrenzheng==1 ? ($.inArray(user.role,[101,9])>=0 ? qjdhtml : renzhenghtml) : '';
				
			  	if (isPc) {
				  	html +=	'<a href="javascript:grouplist_search('+i+')"><h2>'+user.username.substring(0,12)+'</h2>';
				  	html +=	'<h3>☏ '+user.userphone+renzheng+'</h3>'
						    +'<h3>'+user.count+'项' + user.total + '株</h3></a>';		  		
			  	}else{
				  	html +=	'<li onclick="grouplist_search('+i+')"><h2>'+user.username+ renzheng+'</h2>';
					html +=	'<h3>'+'<a href="tel:'+user.userphone+'">☏ '+user.userphone+'</a> '
						    +user.count+'项' + user.total + '株</h3></li>';		  		
			  	}
			}
			
			// html += '<div class="userlist_footer"><img src="/platform/wx'+groupid+'.png" onerror="this.src=\'/platform/wx.png\'"><br>扫描二维码关注<br>'+document.title+'</div>';
			if (isPc) html += '</ul>';

			$('#userlist').html(html);

			if (isPc && (typeof isOpenApi == "undefined")) $('#userlist').height($(window).height());
		});
	} else {
		var html = '<div class="title">'+ document.title + '<br><i>暂无会员单位</i></div>';
			// html += '<div class="userlist_footer"><img src="/platform/wx'+groupid+'.png" onerror="this.src=\'/platform/wx.png\'"><br>扫描二维码关注<br>'+document.title+'</div>';

			$('#userlist').html(html);
	}
}

function grouplist_search(i) {
	var shop = users[i];
	onSearch(shop.userphone);
	$('#s_key').html(shop.username + '<b>╳</b>');
}

addUserList();