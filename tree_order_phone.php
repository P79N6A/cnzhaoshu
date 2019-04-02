<!DOCTYPE html>
<html>
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
    <title>预算采购</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<style type="text/css">
    body{
        margin:0;
        padding:8px;
        color:#434343;
        background-color: #f8f8f8;
        font-family: Helvetica,sans-serif;
        user-select:none;
    }
    #menu{
        z-index:999; 
        position:fixed; 
        bottom:0;
        left: 0;
        width:101%;
    }
    .menu_button {
        -moz-user-select: none;
        border-color: transparent;
        border-right: 1px solid #ccc;
        display: inline-block;
        font-size: 16px;
        font-weight: normal;
        line-height: 1.42857;
        margin-bottom: 0;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background-color: #0089ff;
        color: #ffffff;
        float:left;
        height:40px;
        width:25%;
    }
    .history_button{
        border: 1px solid #fff;
        border-radius: 4px;
        box-sizing: border-box;
        display: inline-block;
        font-size: 13px;
        font-weight: normal;
        background-color: #0089ff;
        color: #fff;
        height:30px;
        width:48%;
    }
    .form-control {
        border: 1px solid #e2e2e4;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: none;
        color: #555;
        font-size: 16px;
        height: 25px;
        padding: 5px 14px;
        margin-bottom:2px;
    }
    .form_control {
        border: 1px solid #e2e2e4;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: none;
        color: #555;
        font-size: 16px;
        height: 30px;
        padding: 5px 6px;
    }

    #order_table{
        width:100%;
    }
    .table{
        border-bottom:1px solid #ddd;
        float: left;
        width:100%;
    }
    .table_order{
        width:8%;
        float:left;
        text-align: center;
        line-height: 28px;
        color: #bbb;
    }
    .table_content{
        width:92%;
        float:left;
    }
    .table_row1_clos1{
        width:33%;
        margin:3px auto;
        float:left;
        line-height:20px;
    }
    .table_row1_clos2{
        width:67%;
        margin:3px auto;
        float:left;
        line-height:20px;
    }
    .table_row2{
        width:98%;
        float:left;
        line-height: 20px;
        margin: 0px 0px 3px 0px;
    }
    .tree_name{
        width:100%;
        margin:2px auto 0px;
        float:left;
    }
    .tree_number{
        width:100%;
        margin:0px auto 2px;
        float:left;
    }
    .table_row1_clos2_data{
        width:33%;
        margin:2px auto;
        float:left;
        text-align: center;
    }
    .addressprice_address{
        width:100%;
        float:left;
    }
    .addressprice_price{
        width:100%;
        float:left;
    }
    .attributein_input{
        width:65%;
        height:40px;
        font-size: 18px;
        float:left;
    }
    .attributein_name{
        width:30%;
        height:40px;
        font-size: 17px;
        float:left;
        line-height: 40px;
        margin-left: 5%;
    }
    #attributein{
        z-index:9999;
        position:fixed;
        bottom:0;  
        left: 0;
        right: 0;
        background-color: #eee;
        display: none;
        box-shadow: 0 0 8px;
        border-radius: 5px 5px 0 0;
    }
    #buttons{
        margin-left:43%;
    }
    #hidden_attributein{
        float: right;
        text-align: right;
        width:100%;
        font-size: 30px;
    }
    .cxselect{
        width:32.33%;
        height:32px;
        float:left;
        line-height:35px;
        margin: 7px 1% 0 0;
    }
    #tree_arrive_address_name{
        float: left;
        width:101%;
    }
    .tree_order_lable{
        padding-top: 15px;
        font-size: 18px;
        float: left;
    }
    #tree_origin_name{
        width:101%;
        float: left;
        /*margin-bottom: 30px;*/
    }
    .provinces_name{
        float:left;
        width:24%;
        box-sizing: border-box;
        -moz-user-select: none;
        border: 1px solid #fff;
        border-radius: 4px;
        display: inline-block;
        font-size: 15px;
        font-weight: normal;
        line-height: 1.42857;
        margin-bottom: 0;
        padding: 4px 0;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background-color: #ddd;
        color: #666666;
        margin:1% 1% 0 0;
    }
    
    #add,#reset {
        border: 1px solid transparent;
        border-radius: 4px;
        box-sizing: border-box;
        display: inline-block;
        font-size: 16px;
        font-weight: normal;
        margin-bottom: 5px;
        margin-right: 12%;
        background-color: #49cfff;
        color: #ffffff;
        float:left;
        height:30px;
        width:35%;
    }   
    #trunk_diameter1,#ground_diameter1,#crown1,#plant_height1,#branch_number1,#bough_number1,#branch_length1,#bough_length1,#pot_diameter1,#branch_point_height1,#age1,#edits,#plant_height_cm1,#crown_cm1,#substrate1{
        display: none;
    }
    #history_orders{
        width:100%;
        float: left;
        margin-bottom: 80px;
        display:none;
    }
    .history_title{
        width:100%;
        line-height: 40px;
        font-size: 20px;
        text-align: center;
        margin-top: 15px;
        float: left;
        border-bottom: 1px solid #ddd;
    }
    .title_ordertime{
        width:28%;
        float: left;
    }
    .title_ordername{
        width:37%;
        float: left;
    }
    .title_edit{
        width:35%;
        float: left;
    }
    #history_order_contents{
        width:100%;
        float: left;
    } 
    .history_order_content{
        width:100%;
        font-size: 16px;
        height:35px;
        float: left;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    .ordername{
        width:57%;
        float: left;
        margin:7px 0px;
        text-align: left;
    }
    .ordertime{
        width:43%;
        float: left;
        line-height: 30px;
    }
    .edit{
        width:35%;
        float: left;
        line-height: 32px;
    }
    #tree_arrive_address_city{
        padding-top: 5px;
        float: left;
        width:100%;
        margin-bottom: 80px;
    }
    .tree_arrive_address_citys {
        float:left;
        width:100%;
        margin-top: 4px;
    }
    .area_city{
        font-size:17px;
        width:25%;
        margin-top: 6px;
        float:left;
        line-height: 20px;
    }
    .area_city_name{
        width:75%;
        float:left;
    }
    .city_bn {
        -moz-user-select: none;
        border: 2px solid #ffffff;
        border-radius: 6px;
        display: inline-block;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.42857;
        margin-bottom: 0;
        padding: 3px 6px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background-color: #ddd;
        color: #666666;
        float: left;
    }
    .alertordername {
        z-index:99999;
        position:fixed;
        bottom:20%;
        left:10%;
        width:80%;
        height:180px;
        border-radius:5px;
        border:solid 2px #aaa;
        background-color:#eee;
        display:none;
        box-shadow: 0 0 10px #666;
    }
    .alert_btn {
        -moz-user-select: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.42857;
        padding: 6px 12px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background-color: #49cfff;
        border-color: #49cfff;
        color: #ffffff;
        width:20%;
        margin-top:4%;
        margin-left:20%;
    }
    .form_control_alert{
        border: 1px solid #e2e2e4;
        box-shadow: none;
        color: #c2c2c2;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        color: #555;
        display: block;
        font-size: 16px;
        height: 23px;
        line-height: 1.3;
        padding: 6px 8px;
        vertical-align: middle;
        margin:10px auto;
        width:78%;
    }
    #label1{
        width:40%;
        float: left;
        margin-left: 10%;
        text-align: center;
        line-height: 35px;
        font-size: 20px;
        border-radius: 3px;
        background:#ccc;
    }
    #label2{
        width:40%;
        float: left;
        text-align: center;
        line-height: 35px;
        border-radius: 3px;
        font-size: 20px;
        background:#fff;
    }
    .title_label{
        width:100%;
        height:50px;
        float: left;
        /*border-bottom: 1px solid #ddd;*/
    }
    #history{
        float:left;
        width:100%;
        font-size: 16px;
    }
    .name{
       float:left;
       height:35px;
       line-height:35px;
       margin-top: 5px;
       font-size: 18px;
       width:13%;
    }
    .key_btn {
        -moz-user-select: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 16px;
        font-weight: normal;
        line-height: 1.4;
        margin-top: 5px;
        margin-bottom: 5px;
        padding: 5px 13px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background-color: #49cfff;
        border-color: #49cfff;
        color: #ffffff;
        float:right;
        margin-right:13%;
    }
    .form-controls{
        border: 1px solid #e2e2e4;
        box-shadow: none;
        color: #c2c2c2;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        color: #555;
        display: block;
        font-size: 16px;
        height: 23px;
        line-height: 1.3;
        padding: 6px 8px;
        vertical-align: middle;
        margin-top:5px;
        width:75%;
        float:left;
    }
    .form-controltime{
        border: 1px solid #e2e2e4;
        box-shadow: none;
        color: #c2c2c2;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        color: #555;
        display: block;
        font-size: 16px;
        height: 23px;
        line-height: 1.3;
        padding: 6px 8px;
        vertical-align: middle;
        margin-top:5px;
        width:29%;
        float:left;
    }
    .hideform {
        border: 1px solid #e2e2e4;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: none;
        color: #555;
        font-size: 16px;
        width:28%;
        padding: 8px 6px;
        margin-bottom: 20px;
    }
    #history_order_content_orders{
        width:100%;
        float:left;
        display:none;
    }
    .history_order_relcontent{
        float:left;
        width:65%;
    }
    .search_titel{
        float:left;
        width:100%;
        background:#ddd;
        border-radius: 4px;
    }
    .search_titel_name{
        float: left;
        width:20%;
        font-size: 25px;
        line-height: 35px;
        margin-left: 40%;
    }
    #search_reset{
        border: 1px solid #bbb;
        border-radius: 4px;
        box-sizing: border-box;
        display: inline-block;
        font-size: 17px;
        font-weight: normal;
        background-color: #bbb;
        color: #fff;
        height:35px;
        line-height: 34px;
        width:15%;
        float: right;
        text-align: center;
        /*margin-right: 5%;*/
    }
    #history_ordername_title{
        float:left;
        width:100%;
        background:#ddd;
        text-align: center;
        line-height: 35px;
        height:35px;
        font-size: 25px;
        border-radius:4px;
    }
</style>
<body>

    <div class="title_label">
        <div id="label1">当前清单</div>
        <div id="label2">历史清单</div>
    </div>

    <div id="current_order">
       <!-- 清单表 -->
       <div id="order_table"></div>

       <!-- 用苗地 -->
       <div>
           <label class="tree_order_lable">用苗地点:</label>
           <div id="tree_arrive_address_name">
               <select class="province cxselect form_control"></select>
               <select class="city cxselect form_control"></select>
               <select class="area cxselect form_control"></select>
           </div>
       </div>

       <!-- 选择苗源地 -->
       <div>
           <div class="tree_order_lable">苗源地点:</div>
           <div id="tree_origin_name"></div>
       </div>
       <div id="tree_arrive_address_city"></div>


       <!-- 菜单选项 -->
       <div id="menu">
           <button class="menu_button" id="join_order">存清单</button>
           <button class="menu_button" id="deal_budget">导预算</button>
           <button class="menu_button" id="deal_purchase">导采购</button>
           <button class="menu_button" id="input_order">录清单</button>
       </div>

       <!-- 录入清单 -->
       <div id="attributein">
           <div id="hidden_attributein">×&nbsp;</div>
           <div>
               <div class="attributein_name">苗木名称:</div>
               <div class="attributein_input"><input type="text" id="name" class="form-control"></div>
           </div>
           <div>
               <div class="attributein_name">数 量(株):</div>
               <div class="attributein_input"><input type="text" onkeyup='this.value=this.value.replace(/\D/gi,"")' id="count" class="form-control"></div>
           </div>
           <div id="trunk_diameter1">
               <div class="attributein_name">胸 径(公分):</div>
               <div class="attributein_input"><input type="text" id="trunk_diameter" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false"  class="form-control"></div>
           </div>
           <div id="ground_diameter1">
               <div class="attributein_name">地 径(公分):</div>
               <div class="attributein_input"><input type="text" id="ground_diameter" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="pot_diameter1">
               <div class="attributein_name">盆 径(公分):</div>
               <div class="attributein_input"><input type="text" id="pot_diameter" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="plant_height1">
               <div class="attributein_name">株 高(米):</div>
               <div class="attributein_input"><input type="text" id="plant_height" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="plant_height_cm1">
               <div class="attributein_name">株 高(公分):</div>
               <div class="attributein_input"><input type="text" id="plant_height_cm" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="crown1">
               <div class="attributein_name">冠 幅(米):</div>
               <div class="attributein_input"><input type="text" id="crown" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="crown_cm1">
               <div class="attributein_name">冠 幅(公分):</div>
               <div class="attributein_input"><input type="text" id="crown_cm" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="branch_number1">
               <div class="attributein_name">分 枝 数(个):</div>
               <div class="attributein_input"><input type="text" id="branch_number" placeholder="10" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="bough_number1">
               <div class="attributein_name">主 枝 数(个):</div>
               <div class="attributein_input"><input type="text" id="bough_number" placeholder="10" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="branch_length1">
               <div class="attributein_name">条 长(米):</div>
               <div class="attributein_input"><input type="text" id="branch_length" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="bough_length1">
               <div class="attributein_name">主蔓(枝)长(米):</div>
               <div class="attributein_input"><input type="text" id="bough_length" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="branch_point_height1">
               <div class="attributein_name">分枝点高(米):</div>
               <div class="attributein_input"><input type="text" id="branch_point_height" placeholder="10或10-20" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="age1">
               <div class="attributein_name">苗 龄(年):</div>
               <div class="attributein_input"><input type="text" id="age" placeholder="10" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" class="form-control"></div>
           </div>
           <div id="substrate1">
               <div class="attributein_name">基 质:</div>
               <div class="attributein_input"><input type="text" id="substrate" class="form-control"></div>
           </div>
           <div id="buttons">
               <button type="button" id="add">添加</button><button type="button" id="reset">清空</button>
           </div>
       </div>

       <div class="alertordername">
           <div style="text-align:center;margin:6% 0px;"><h3>输入您的订单名称</h3></div>
           <input type="text" id="order_name" class="form_control_alert">
           <button type="button" id="order_name_button" class="alert_btn">提交</button>
           <button type="button" id="order_name_button_reset" class="alert_btn">取消</button>
       </div> 
    </div>
    
    <!-- 历史清单 -->
    <div id="history_orders">
        <div id="history_order_content_orders">
            <div id="history_ordername_title"></div>
            <div id="history_order_content_order">
            </div>
            <input type="text" name="province" class="hideform">
            <input type="text" name="city" class="hideform">
            <input type="text" name="area" class="hideform">
        </div>
        <div id="history">
            <div class="search_titel"><div class="search_titel_name">搜索</div><div id="search_reset">清除</div></div>
            <div class="name">名称</div><input type="text" id="key_name" class="form-controls">
            <div class="name">地址</div><input type="text" id="key_area" class="form-controls">
            <div class="name">时间</div><input type="date" id="key_time1" class="form-controltime"><div style="float:left;margin-top:14px;width:6%;text-align:center">至</div><input type="date" id="key_time2" class="form-controltime">
        </div>
        <div class="history_title">
            <div class="title_ordername">订单名称</div>
            <div class="title_ordertime">订单日期</div>
            <div class="title_edit">操作</div>
        </div>
        <div id="history_order_contents">
        </div>
    </div>

    <a style="display:block;float:left;margin-bottom:50px;text-decoration:none;color:blue;width:100%;text-align:center" href="http://mp.weixin.qq.com/s/2khGqU2ownDGgyiKmpF9uQ">找树网“预算采购”功能视频讲解</a>

    <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
    <script src="js/jquery.cxselect.min.js"></script>

    <script type="text/javascript">
        // var user = {userid:29908};
        // 随机编号
        var rand;
        // 录入数据
        var data = [];
        // 当前在第几条
        var datan = 0;
        // 每条数据所在省份
        var provinces = [];
        // 修改的对象
        var editen;
        // 编号 所对应选择苗源地址和价格
        var addressprice = [];
        var unit;
        var typename;
        var type;
        // 地址和价格信息
        var addresspricess;
        // 订单信息
        var datas;
        // 详细地址
        var detailed_address;
        // 历史清单
        var order_detail = [];
        // 各个城市的价格
        var pricescity = [];
        var sohard = [];
        var cities = '';
        var finalkey;
        var finalprice;
        var fatherprivious = '';
        var button_ordernumber = 0;
        var provinces_name = ['安徽','北京','重庆','福建','甘肃','广东','广西','贵州','海南','河北','河南','黑龙江','湖北','湖南','山东','吉林','江苏','江西','辽宁','内蒙古','宁夏','青海','山西','陕西','上海','四川','天津','新疆','云南','浙江'];
        

        function loadHistoryData(){
            html = '';
                $.getJSON('/com/order_temp_search.php',{uid:user.userid},function(json){
                    if(json){
                        var counts = 0;
                        for (var i = 0; i < json.length; i++) {

                            data[i] = json[i];
                            datan = 1+i;
                            var attr = attributes_show(json[i]);
                            attribute_shift(data[i]);

                            html += '<div class="table">';
                            html += '<input type="hidden" name="id" class="id"  value="'+json[i].id+'">';
                            html += '<div class="table_order">'+datan+'</div>';
                            html += '<div class="table_content">';
                            html += '<div class="table_row1_clos1">';
                            html += '<div class="tree_name">'+json[i].name+'</div>';
                            html += '<div class="tree_number">'+json[i].count+json[i].unit+'</div>';
                            html += '</div>';
                            html += '<div class="table_row1_clos2">';
                            html += '</div>';
                            html += '<div class="table_row2">'+attr+'</div>';
                            html += '</div>';
                            html += '</div>';   
                                    
                        }
                        selectarea(data);
                        $('#order_table').html(html);
                    }
                });
        }

        function selectarea(condition){
            $.getJSON('/com/search_price_batch.php',{data:JSON.stringify(condition)},function(json){
                for (var i = 0; i < json.length; i++) {
                    provinces[i] = [];
                    addressprice[i] = {};
                    for (var y = 0; y < condition.length; y++) {
                        if(condition[y].id == json[i].id){
                            addressprice[i].id = json[i].id;
                            if(json[i].price){
                                var p = 0;
                                addressprice[i].price = [];
                                for (var z = 0; z < json[i].price.length; z++) {
                                    // if(json[i].price[z].total >= condition[y].count){
                                        addressprice[i].price[p] = json[i].price[z];
                                        provinces[i][p] = json[i].price[z].province;
                                        p++;
                                    // }
                                }
                            }else{
                                addressprice[i].price = [];
                                provinces[i] = '';
                            }
                        }
                    }
                }
                var haves = [''];
                for (var x = 0; x < provinces.length; x++) {
                    for (var z = 0; z < provinces[x].length; z++) {
                        var y = 0;
                        for (var i = 0; i < haves.length; i++) {
                            if(haves[i] != provinces[x][z]){
                                ++y;
                            }
                            if(y == haves.length){
                                haves[haves.length] = provinces[x][z];
                            }
                        }
                    }
                }   
                // 显示交集省份
                $('.provinces_name').hide();
                for (var i = 0; i < haves.length; i++) {
                    $('#tree_origin_name input[type="checkbox"][value="'+haves[i]+'"]').parent().show();
                }   

            });
        }
        
        function attribute_shift(shift){
            if(shift.trunk_diameter){
                shift.trunk_diameter = shift.trunk_diameter.split(',');
            }
            if(shift.ground_diameter){
                shift.ground_diameter = shift.ground_diameter.split(',');
            }
            if(shift.plant_height){
                shift.plant_height = shift.plant_height.split(',');
            }
            if(shift.crown){
                shift.crown = shift.crown.split(',');
            }
            if(shift.branch_number){
                shift.branch_number = shift.branch_number.split(',');
            }
            if(shift.bough_number){
                shift.bough_number = shift.bough_number.split(',');
            }
            if(shift.age){
                shift.age = shift.age.split(',');
            }
            if(shift.branch_length){
                shift.branch_length = shift.branch_length.split(',');
            }
            if(shift.bough_length){
                shift.bough_length = shift.bough_length.split(',');
            }
            if(shift.branch_point_height){
                shift.branch_point_height = shift.branch_point_height.split(',');
            }
            if(shift.pot_diameter){
                shift.pot_diameter = shift.pot_diameter.split(',');
            }
            if(shift.crown_cm){
                shift.crown_cm = shift.crown_cm.split(',');
            }
            if(shift.plant_height_cm){
                shift.plant_height_cm = shift.plant_height_cm.split(',');
            }
        }

        function attributes_show(data_attribute){
            var attr = '';
            if(data_attribute.trunk_diameter){
                var at = data_attribute.trunk_diameter.replace(',','-');
                attr += '胸径:'+at+'公分 ';
            }
            if(data_attribute.ground_diameter){
                var at = data_attribute.ground_diameter.replace(',','-');
                attr += '地径:'+at+'公分 ';
            }
            if(data_attribute.pot_diameter){
                var at = data_attribute.pot_diameter.replace(',','-');
                attr += '盆径:'+at+'公分 ';
            }
            if(data_attribute.plant_height){
                var at = data_attribute.plant_height.replace(',','-');
                attr += '株高:'+at+'米 ';
            }
            if(data_attribute.plant_height_cm){
                var at = data_attribute.plant_height_cm.replace(',','-');
                attr += '株高:'+at+'公分 ';
            }
            if(data_attribute.crown){
                var at = data_attribute.crown.replace(',','-');
                attr += '冠幅:'+at+'米 ';
            }
            if(data_attribute.crown_cm){
                var at = data_attribute.crown_cm.replace(',','-');
                attr += '冠幅:'+at+'公分 ';
            }
            if(data_attribute.branch_number){
                var at = data_attribute.branch_number.replace(',','-');
                attr += '分枝数:'+at+'个 ';
            }
            if(data_attribute.bough_number){
                var at = data_attribute.bough_number.replace(',','-');
                attr += '主枝数:'+at+'个 ';
            }
            if(data_attribute.age){
                var at = data_attribute.age.replace(',','-');
                attr += '苗龄:'+at+'年 ';
            }
            if(data_attribute.branch_length){
                var at = data_attribute.branch_length.replace(',','-');
                attr += '条长:'+at+'米 ';
            }
            if(data_attribute.bough_length){
                var at = data_attribute.bough_length.replace(',','-');
                attr += '主蔓(枝)长:'+at+'米 ';
            }
            if(data_attribute.branch_point_height){
                var at = data_attribute.branch_point_height.replace(',','-');
                attr += '分枝点高:'+at+'米 ';
            }
            if(data_attribute.substrate){
                var at = data_attribute.substrate;
                attr += '基质:'+at;
            }
            
            return attr;
        }
        
        function loadprovincesaddress(){
            var html = '';
            for (var i = 0; i < provinces_name.length; i++) {
                html += '<label class="provinces_name" style="display:none"><input type="checkbox" value="'+provinces_name[i]+'">'+provinces_name[i]+'</label>';
            }
            $('#tree_origin_name').html(html);
        };  

        function toadd(){
            var caozuo = $('#add').html();
            var content = {};
            if($.trim($('#name').val())!='') content.name = $('#name').val();
            if($.trim($('#trunk_diameter').val())!='') content.trunk_diameter = sort($('#trunk_diameter').val());
            if($.trim($('#plant_height').val())!='') content.plant_height = sort($('#plant_height').val());
            if($.trim($('#crown').val())!='') content.crown = sort($('#crown').val());
            if($.trim($('#branch_point_height').val())!='') content.branch_point_height = sort($('#branch_point_height').val());
            if($.trim($('#branch_number').val())!='') content.branch_number = sort($('#branch_number').val());
            if($.trim($('#ground_diameter').val())!='') content.ground_diameter = sort($('#ground_diameter').val());
            if($.trim($('#bough_number').val())!='') content.bough_number = sort($('#bough_number').val());
            if($.trim($('#plant_height_cm').val())!='') content.plant_height_cm = sort($('#plant_height_cm').val());
            if($.trim($('#crown_cm').val())!='') content.crown_cm = sort($('#crown_cm').val());
            if($.trim($('#age').val())!='') content.age = sort($('#age').val());
            if($.trim($('#branch_length').val())!='') content.branch_length = sort($('#branch_length').val());
            if($.trim($('#pot_diameter').val())!='') content.pot_diameter = sort($('#pot_diameter').val());
            if($.trim($('#bough_length').val())!='') content.bough_length = sort($('#bough_length').val());
            if($.trim($('#substrate').val())!='') content.substrate = $('#substrate').val();
            if($.trim($('#count').val())!='') content.count = $('#count').val();
            if(isEmptyObject(content) && (content.count != null) && (content.name != null)){
                if(unit || typename || type){
                    content.unit = unit;
                    content.typename = typename;
                    content.type = type;
                }else{
                    content.unit = '株';
                    content.typename = '无';
                    content.type = 11;
                }
                $('#attributein input').val('');
                hideattribute();
                var attr = guige(content);
                    if(caozuo == '添加'){
                        randomget();
                        content.id = rand;
                        rand = '';

                        screenaddress(content);
                        data[datan] = content;
                        datan++;
                        var m = 0;
                        for (var i = 0; i < data.length; i++) {
                            if(data[i]){
                                m++;
                            }
                        }

                        html += '<div class="table">';
                        html += '<input type="hidden" name="id" class="id"  value="'+content.id+'">';
                        html += '<div class="table_order">'+m+'</div>';
                        html += '<div class="table_content">';
                        html += '<div class="table_row1_clos1">';
                        html += '<div class="tree_name">'+content.name+'</div>';
                        html += '<div class="tree_number">'+content.count+content.unit+'</div>';
                        html += '</div>';
                        html += '<div class="table_row1_clos2">';
                        html += '<div class="table_row1_clos2_data">';
                        html += '<div class="addressprice_address">山东</div>';
                        html += '<div class="addressprice_price">51000</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="table_row2">'+attr+'</div>';
                        html += '</div>';
                        html += '</div>';

                        var counts = 0;
                        for (var i = 0; i < data.length; i++) {
                            if(data[i]){
                                counts += parseInt(data[i].count);
                            }
                        }
                            $('#order_table').html(html);
                        $.get('/com/order_temp_add.php',{uid:user.userid, data:JSON.stringify(content)},function(){
                            
                        });
                    }else{
                        
                        content.id =  dataid;
                        screenaddress(content);
                            data[editen] = content;
                            $('#add').html('添加');
                            $('#reset').html('清空');
                        $.get('/com/order_temp_update.php',{uid:user.userid, data:JSON.stringify(content)},function(){

                        });
                    }
            }else{
                alert('名称或数量未填写');
            }
        }

        function randomget(){
            rand = parseInt(Math.random()*1000000000);
            if(rand < 100000000 || rand == 1000000000){
                randomget();
            }else{
                rand = '050'+rand;
                return rand;
            }
        }

        function guige(content){
            var attr = '';
            if(parseFloat(content.trunk_diameter) > 0){
                attr += ' 胸径:'+mark(content.trunk_diameter)+'cm';
            }
            if(parseFloat(content.ground_diameter) > 0){
                attr += ' 地径:'+mark(content.ground_diameter)+'cm';
            }
            if(parseFloat(content.pot_diameter) > 0){
                attr += ' 盆径:'+mark(content.pot_diameter)+'cm';
            }
            if(parseFloat(content.plant_height) > 0){
                attr += ' 株高:'+mark(content.plant_height)+'m';
            }
            if(parseFloat(content.plant_height_cm) > 0){
                attr += ' 株高:'+mark(content.plant_height_cm)+'cm';
            }
            if(parseFloat(content.crown) > 0){
                attr += ' 冠幅:'+mark(content.crown)+'m';
            }
            if(parseFloat(content.crown_cm) > 0){
                attr += ' 冠幅:'+mark(content.crown_cm)+'cm';
            }
            if(parseFloat(content.branch_number) > 0){
                attr += ' 分枝数:'+mark(content.branch_number)+'个';
            }
            if(parseFloat(content.bough_number) > 0){
                attr += ' 主枝数:'+mark(content.bough_number)+'个';
            }
            if(parseFloat(content.age) > 0){
                attr += ' 苗龄:'+mark(content.age)+'年';
            }
            if(parseFloat(content.branch_length) > 0){
                attr += ' 条长:'+mark(content.branch_length)+'m';
            }
            if(parseFloat(content.bough_length) > 0){
                attr += ' 主蔓(枝)长:'+mark(content.bough_length)+'m';
            }
            if(parseFloat(content.branch_point_height) > 0){
                attr += ' 分枝点高:'+mark(content.branch_point_height)+'m';
            }
            if(content.substrate != undefined){
                attr += ' 基质:'+content.substrate;
            }
            return attr;
        }

        function mark(att){
            if(att){
                if(att[1]){
                    return att[0]+'-'+att[1];
                }else if(parseFloat(att[0]) > 0){
                    return att[0];
                }
            }
        }

        function screenaddress(tiaojian){
            $.getJSON('/com/search_price.php',{data:JSON.stringify(tiaojian)},function(json){
                var info = json.price;
                    // 将省份信息给addressprice数组
                    if(editen > -1){
                        addressprice[editen] = json;
                        editen = -1;
                    }else{
                        addressprice[datan-1] = json;
                    }
                if(json.price){
                    var infoprovinces = [];
                    // 获取省份信息给provinces数组中
                    var m = 0;
                    for (var i = 0; i < info.length; i++) {
                        m += 1;
                        var count = info[i].count;
                        var province = info[i].province;
                        var total = info[i].total;
                        // if(total >= tiaojian.count){
                            infoprovinces[i] = province;
                        // }
                    }
                    provinces[datan-1] = infoprovinces;
                }
                    var haves = [''];

                    for (var x = 0; x < provinces.length; x++) {
                        for (var z = 0; z < provinces[x].length; z++) {
                            var y = 0;
                            for (var i = 0; i < haves.length; i++) {
                                if(haves[i] != provinces[x][z]){
                                    ++y;
                                }
                                if(y == haves.length){
                                    haves[haves.length] = provinces[x][z];
                                }
                            }
                        }
                    }   
                    $('.provinces_name').hide();
                    $('.tree_arrive_address_citys').hide();
                    $('input[type="checkbox"]').prop("checked",false);
                    cities = '';
                    fatherprivious = '';
                    pricescity = [];
                    sohard = [];
                    for (var i = 0; i < haves.length; i++) {
                        $('#tree_origin_name input[type="checkbox"][value="'+haves[i]+'"]').parent().show();
                    }   
                    showprice();
                    
            });
        }
        
        function sort(req){

            return req.replace('－','-').replace('。','.').replace('一','-').replace('_','-').split('-');
        }
        
        function findname(){
            // 发送ajax查询名称所对应的属性
            var name = $('#name').val();
            var json;
            for (var i = 0; i < dictionary.length; i++) {
                if(dictionary[i].name == name){
                    json = dictionary[i];
                }
            }   
            var dictionary_attributes = {5:'trunk_diameter',6:'ground_diameter',7:'pot_diameter',8:'age',9:'crown',10:'plant_height',11:'branch_length',12:'bough_length',13:'branch_point_height',14:'branch_number',15:"bough_number",17:'plant_height_cm',18:'crown_cm',19:'substrate'};
            for (var i = 5; i < 20; i++) {
              $('#'+dictionary_attributes[i]+'1').hide();
            }

            if(!json){
                $('#name-id').val(name);
                $('#trunk_diameter1').show();
                $('#crown1').show();
                $('#plant_height1').show();
            }else{
                var attribute = json.attribute;
                unit = json.unit;
                typename = json.typename;
                type = json.type;
                var attributes = attribute.split(',');
                for (var z = 0; z < attributes.length; z++) {
                    if(dictionary_attributes[ attributes[z] ]){
                        $('#'+dictionary_attributes[ attributes[z] ]+'1').show();
                    }
                }
            }
        };

        function hideattribute(){
            var dictionary_attributes = {5:'trunk_diameter',6:'ground_diameter',7:'pot_diameter',8:'age',9:'crown',10:'plant_height',11:'branch_length',12:'bough_length',13:'branch_point_height',14:'branch_number',15:"bough_number",17:'plant_height_cm',18:'crown_cm',19:'substrate'};
            for (var i = 5; i < 20; i++) {
                $('#'+dictionary_attributes[i]+'1').hide();
            }
        }
        
        function isEmptyObject(e) {  
            var t;  
            for (t in e)  
                return true;  
            return false;  
        }  

        function showprice(){
            finalkey = [];
            finalprice = [];
            var allprice = [];
            var allareaprice = [];
            var shengfen = '';
            $('#tree_origin_name input:checkbox:checked').each(function() {
                shengfen += $(this).val()+',';
            });
            shengfen = shengfen.substring(0,shengfen.length-1);
            var htmld = '';
            shengfen = shengfen.split(',');
            var countes = 0;
            for (var z = 0; z < shengfen.length; z++) {
                allprice[z] = 0;
            }
            for (var q = 0; q < cities.length; q++) {
                allareaprice[q] = 0;
            }
            var y = 0;
            for (var i = 0; i < data.length; i++) {
                if(data[i]){
                    y++;
                    var k = y - 1;
                    finalprice[k] = [];
                    var attr = guige(data[i]);
                    var price = addressprice[i].price;
                    htmld += '<div class="table">';
                    htmld += '<input type="hidden" name="id" class="id"  value="'+data[i].id+'">';
                    htmld += '<div class="table_order">'+y+'</div>';
                    htmld += '<div class="table_content">';
                    htmld += '<div class="table_row1_clos1">';
                    htmld += '<div class="tree_name">'+data[i].name+'</div>';
                    htmld += '<div class="tree_number">'+data[i].count+data[i].unit+'</div>';
                    htmld += '</div>';
                    htmld += '<div class="table_row1_clos2">';

                    for (var x = 0; x < shengfen.length; x++) {
                        if(shengfen[x]){

                            var tt = 0;
                            if(fatherprivious){
                                for (var t = 0; t < fatherprivious.length; t++) {
                                    if(fatherprivious[t] == shengfen[x]){
                                        tt = 1;
                                    }
                                }
                            }
                            if(tt == 0){
                                htmld += '<div class="table_row1_clos2_data">';
                                htmld += '<div class="addressprice_address">'+shengfen[x]+'</div>';
                                finalkey[finalkey.length] = shengfen[x];
                                var z = 0;
                                if(addressprice[i].price[0]){
                                    for (var m = 0; m < price.length; m++) {

                                        if(price[m].province == shengfen[x]){
                                            htmld += '<td class="addressprice_price">'+(price[m].avg).toFixed(0)+'</td>';
                                            finalprice[k][finalprice[k].length] = price[m].avg;
                                        }else{
                                            ++z;
                                        }
                                        if(z == price.length){
                                            htmld += '<div class="addressprice_price">0</div>';
                                            finalprice[k][finalprice[k].length] = 0;
                                        }
                                    }
                                }else{
                                    htmld += '<div class="addressprice_price">0</div>';
                                    finalprice[k][finalprice[k].length] = 0;
                                }
                                htmld += '</div>';
                            }


                        }
                    }

                    if(cities[0]){
                        for (var z = 0; z < shengfen.length; z++) {
                            for (var q = 0; q < cities.length; q++) {
                                var parentss = $('input[value='+cities[q]+']').parents('.tree_arrive_address_citys').find('.area_city').html();
                                parentss = parentss.replace(':','');
                                if(parentss == shengfen[z]){
                                    htmld += '<div class="table_row1_clos2_data">';
                                    htmld += '<div class="addressprice_address">'+cities[q]+'</div>';
                                    finalkey[finalkey.length] = cities[q];
                                    if(pricescity[shengfen[z]][i][cities[q]] != undefined){
                                        var pricesss = pricescity[shengfen[z]][i][cities[q]];
                                        if(pricesss){
                                            htmld += '<td class="addressprice_price">'+pricesss+'</td>';
                                            finalprice[k][finalprice[k].length] = pricesss;
                                        }else if(sohard[shengfen[z]][cities[q]]){
                                            htmld += '<div class="addressprice_price">0</div>';
                                            finalprice[k][finalprice[k].length] = 0;
                                        }
                                    }else{
                                        htmld += '<div class="addressprice_price">0</div>';
                                        finalprice[k][finalprice[k].length] = 0;
                                    }
                                    htmld += '</div>';
                                    
                                }
                            }
                        }
                    }


                    htmld += '</div>';
                    htmld += '<div class="table_row2">'+attr+'</div>';
                    htmld += '</div>';
                    htmld += '</div>';
                }
            }
            $('#order_table').html();
            $('#order_table').html(htmld);
        }

        function bindInputEvent ()  {
            $('#name').blur(function(){
                findname();
            })
        }

        function attributeedite(){
            var content = data[editen];
            var dictionary_attributes = {5:'trunk_diameter',6:'ground_diameter',7:'pot_diameter',8:'age',9:'crown',10:'plant_height',11:'branch_length',12:'bough_length',13:'branch_point_height',14:'branch_number',15:"bough_number",17:'plant_height_cm',18:'crown_cm',19:'substrate'};
            for (var i = 5; i < 20; i++) {
                if(content[dictionary_attributes[i]]){
                    $('#'+dictionary_attributes[i]+'1').css('display','black');
                    $('#'+dictionary_attributes[i]).val(content[dictionary_attributes[i]]);
                }
            }
            $('#add').html('修改');
            $('#reset').html('删除');
            // 隐藏规格
            hideattribute();
            $('#attributein').show();
            var name = $('#name').val(content.name);
            findname();
            $('#count').val(content.count);
            $('#trunk_diameter').val(join(content.trunk_diameter));
            $('#plant_height').val(join(content.plant_height));
            $('#crown').val(join(content.crown));
            $('#branch_point_height').val(join(content.branch_point_height));
            $('#branch_number').val(join(content.branch_number));
            $('#ground_diameter').val(join(content.ground_diameter));
            $('#bough_number').val(join(content.bough_number));
            $('#crown_cm').val(join(content.crown_cm));
            $('#plant_height_cm').val(join(content.plant_height_cm));
            $('#age').val(join(age));
            $('#branch_length').val(join(content.branch_length));
            $('#pot_diameter').val(join(content.pot_diameter));
            $('#bough_length').val(join(content.bough_length));
        }

        function showattributeindex() {
            var content = data[editen];
            var indexdata = '"exact":1,"key":"'+content.name+'"';
            if(content.trunk_diameter){
                if(content.trunk_diameter[1]){
                    indexdata += ',"dbh":"'+content.trunk_diameter[0]+'-'+content.trunk_diameter[1]+'"';
                }else if(content.trunk_diameter[0]){
                    indexdata += ',"dbh":"'+content.trunk_diameter[0]+'"';
                }
            }else if(content.ground_diameter){
                if(content.ground_diameter[1]){
                    indexdata += ',"dbh":"'+content.ground_diameter[0]+'-'+content.ground_diameter[1]+'"';
                }else if(content.ground_diameter[0]){
                    indexdata += ',"dbh":"'+content.ground_diameter[0]+'"';
                }
            }else if(content.pot_diameter){
                if(content.pot_diameter[1]){
                    indexdata += ',"dbh":"'+content.pot_diameter[0]+'-'+content.pot_diameter[1]+'"';
                }else if(content.pot_diameter[0]){
                    indexdata += ',"dbh":"'+content.pot_diameter[0]+'"';
                }
            }
            if(content.plant_height){
                if(content.plant_height[1]){
                    indexdata += ',"height":"'+content.plant_height[0]+'-'+content.plant_height[1]+'"';
                }else if(content.plant_height[0]){
                    indexdata += ',"height":"'+content.plant_height[0]+'"';
                }
            }else if(content.branch_length){
                if(content.branch_length[1]){
                    indexdata += ',"height":"'+content.branch_length[0]+'-'+content.branch_length[1]+'"';
                }else if(content.branch_length[0]){
                    indexdata += ',"height":"'+content.branch_length[0]+'"';
                }
            }else if(content.bough_length){
                if(content.bough_length[1]){
                    indexdata += ',"height":"'+content.bough_length[0]+'-'+content.bough_length[1]+'"';
                }else if(content.bough_length[0]){
                    indexdata += ',"height":"'+content.bough_length[0]+'"';
                }
            }else if(content.plant_height_cm){
                if(content.plant_height_cm[1]){
                    indexdata += ',"height":"'+(content.plant_height_cm[0])/100+'-'+(content.plant_height_cm[1])/100+'"';
                }else if(content.plant_height_cm[0]){
                    indexdata += ',"height":"'+(content.plant_height_cm[0])/100+'"';
                }
            }
            if(content.crown){
                if(content.crown[1]){
                    indexdata += ',"crownwidth":"'+content.crown[0]+'-'+content.crown[1]+'"';
                }else if(content.crown[0]){
                    indexdata += ',"crownwidth":"'+content.crown[0]+'"';
                }
            }
            if(content.crown_cm){
                if(content.crown_cm[1]){
                    indexdata += ',"crownwidth":"'+(content.crown_cm[0])/100+'-'+(content.crown_cm[1])/100+'"';
                }else if(content.crown_cm[0]){
                    indexdata += ',"crownwidth":"'+(content.crown_cm[0])/100+'"';
                }
            }
            if(content.branch_point_height){
                if(content.branch_point_height[1]){
                    indexdata += ',"branch_point_height":"'+content.branch_point_height[0]+'-'+content.branch_point_height[1]+'"';
                }else if(content.branch_point_height[0]){
                    indexdata += ',"branch_point_height":"'+content.branch_point_height[0]+'"';
                }
            }
            if(content.branch_number){
                if(content.plant_height[1]){
                    indexdata += ',"branch_bough_number":"'+content.branch_number[0]+'-'+content.branch_number[1]+'"';
                }else if(content.branch_number[0]){
                    indexdata += ',"branch_bough_number":"'+content.branch_number[0]+'"';
                }
            }
            if(content.bough_number){
                if(content.bough_number[1]){
                    indexdata += ',"branch_bough_number":"'+content.bough_number[0]+'-'+content.bough_number[1]+'"';
                }else if(content.bough_number[0]){
                    indexdata += ',"branch_bough_number":"'+content.bough_number[0]+'"';
                }
            }
            if(content.substrate){
                if(content.substrate){
                    indexdata += ',"substrate":"'+content.substrate+'"';
                }
            }
            window.location = 'http://cnzhaoshu.com/m.php?where={'+indexdata+'}';
            snake = -1; 
        }

        function join(req){
            if(req){
                if(req[1]){
                    return req[0]+'-'+req[1];
                }else{
                    return req[0];
                }
            }
        }

        function reset(){
            var rightbtnname = $('#reset').html();
            if(rightbtnname == '清空'){
                $('#attributein input').val('');
            }else{
                var deleteid = data[editen]['id'];
                data[editen] = '';
                addressprice[editen] = '';
                provinces[editen] = '';
                var haves = [''];
                for (var x = 0; x < provinces.length; x++) {
                    for (var z = 0; z < provinces[x].length; z++) {
                        var y = 0;
                        for (var i = 0; i < haves.length; i++) {
                            if(haves[i] != provinces[x][z]){
                                ++y;
                            }
                            if(y == haves.length){
                                haves[haves.length] = provinces[x][z];
                            }
                        }
                    }
                }
                $('.provinces_name').hide();
                for (var i = 0; i < haves.length; i++) {
                    $('#tree_origin_name input[type="checkbox"][value="'+haves[i]+'"]').parent().show();
                }   

                $('#tree_origin_name input:checkbox:checked').each(function() {
                    if($(this).is(':visible') == false)
                        $(this).prop("checked",false);
                });

                showprice();
                editen = -1;
                $('#attributein input').val('');
                hideattribute();
                $('#add').html('添加');
                $('#reset').html('清空');
                // 删除数据
                $.get('/com/order_temp_deletepc.php',{userid:user.userid, id:deleteid},function(){
                });
            }
        }
        
        
        function final_deal(){
            var province = $(".province").val();
            var city = $(".city").val();
            var area = $(".area").val();
            if(province) detailed_address = province;
            if(city) detailed_address += '.'+city;
            if(area) detailed_address += '.'+area;
            var finalallprice = [];
            var as = 0;
            for (var x = 0; x < data.length; x++) {
                if(data[x]){
                    finalallprice[as] = {};
                    finalallprice[as].id = data[x].id;
                    as++;
                }
            }
            if(finalkey){
                var sss = finalkey.length/finalprice.length;
                for (var x = 0; x < finalprice.length; x++) {
                    for (var i = 0; i < sss; i++) {
                        finalallprice[x][finalkey[i]] = finalprice[x][i];
                    }
                }
                var newdata = 0;
                var typedata = [];
                var typeaddressprices = finalallprice;
                for (var i = 1; i < 12; i++) {
                    for (var x = 0; x < data.length; x++) {
                        if((data[x].type == i) && data[x]){
                            typedata[newdata] = data[x];
                            newdata++;
                        }
                    }
                }
            }else{
                var newdata = 0;
                var typedata = [];
                var typeaddressprices = 1;
                for (var i = 1; i < 12; i++) {
                    for (var x = 0; x < data.length; x++) {
                        if((data[x].type == i) && data[x]){
                            typedata[newdata] = data[x];
                            newdata++;
                        }
                    }
                }
            }   
            datas = JSON.stringify(typedata);
            addresspricess = JSON.stringify(typeaddressprices);
        }

        function loadHistoryOrder(){
            $.cxSelect.defaults.url = 'js/chinaarea.min.json';
            $.getJSON('/com/order_index_search.php',{userid:user.userid},function(json){
                if(json){
                    var address = json[json.length-1].address;
                    if(address != 0){
                        var orderaddress = address.split('.');
                        if(orderaddress[0]) $('.province').attr('data-value',orderaddress[0]);
                        if(orderaddress[1]) $('.city').attr('data-value',orderaddress[1]);
                        if(orderaddress[2]) $('.area').attr('data-value',orderaddress[2]);
                    }else{
                        $('.province').attr('data-value','北京市');
                        $('.city').attr('data-value','通州区');
                    }
                    var history_order = '';
                    for (var i = 0; i < json.length; i++) {
                        history_order += '<div class="history_order_content"><div class="history_order_relcontent">'; 
                        history_order += '<div class="ordername">'+json[i].ordername+'</div>';   
                        history_order += '<div class="ordertime">'+makesimple(json[i].time)+'</div>'; 
                        history_order += '<input type="hidden" class="history_orderid" value="'+json[i].id+'">';
                        history_order += '<input type="hidden" class="history_orderaddress" value="'+json[i].address+'">';
                        history_order += '</div><div class="edit"><button type="button" class="history_button history_order_delete">删除</button><button type="button" class="history_button history_order_copy">另存</button></div>';   
                        history_order += '</div>';  
                        
                    }
                    $('#history_order_contents').html(history_order); 
                }
            });
            $('#tree_arrive_address_name').cxSelect({
                selects: ['province', 'city', 'area']
            });
        }

        function loaddictionary(){
            $.getJSON('/com/dictionary_attribute_search.php',function(json){
                if (json) {
                    dictionary = json;
                }
            });
        }
        

        function makesimple(time){

            return time.split(' ')[0];
        }

        $('#tree_origin_name').on('change','.provinces_name',function(){

            var areahtml = '';
            var shengfen = '';
            $('#tree_origin_name input:checkbox:checked').each(function() {
                shengfen += $(this).val()+',';
            });
            if(shengfen.length > 0){
                shengfen = shengfen.substring(0,shengfen.length-1);
                shengfen = shengfen.split(',');
                for (var i = 0; i < shengfen.length; i++) {
                        var citys = haveareacity(shengfen[i]);
                        if(citys){
                            areahtml += '<div class="tree_arrive_address_citys">';
                            areahtml += '<div class="area_city">'+shengfen[i]+':</div>';
                            areahtml += '<div class="area_city_name">';
                            sohard[shengfen[i]] = [];
                            for (var x = 0; x < citys.length; x++) {
                                areahtml += '<label class="city_bn"><input type="checkbox" value="'+citys[x]+'">'+citys[x]+'</label>';
                                sohard[shengfen[i]][citys[x]] = 1;
                            }

                            areahtml += '</div>';
                            areahtml += '</div>';
                        }
                }
                $('#tree_arrive_address_city').html(areahtml);
            }else{
                $('#tree_arrive_address_city').html('');
            }
            if(cities != ''){
                for (var i = 0; i < cities.length; i++) {
                    $('input[value='+cities[i]+']').attr('checked','checked');
                }
            }
            showprice();
        });

        $('#tree_arrive_address_city').on('change','.city_bn',function(){
            var fouk = '';
            cities = '';
            $('#tree_arrive_address_city input:checkbox:checked').each(function() {
                cities += $(this).val()+',';
                fouk += $(this).parents('.tree_arrive_address_citys').find('.area_city').html();
            });
            if(cities.length > 0){
                cities = cities.substring(0,cities.length-1);
                cities = cities.split(',');
            }
            if(fouk.length > 0){
                fouk = fouk.substring(0,fouk.length-1);
                fouk = fouk.split(':');
            }
            fatherprivious = fouk;
            showprice();
        });

        function haveareacity(same){
            var areacity = '';
            pricescity[same] = [];
            for (var i = 0; i < addressprice.length; i++) {
                if(addressprice[i]){
                    pricescity[same][i] = [];
                    var areaprice = addressprice[i].price;
                    if(areaprice){
                        for (var x = 0; x < areaprice.length; x++) {
                            if(areaprice[x].province == same){
                                var areacitys = areaprice[x].city;
                                for (var y = 0; y < areacitys.length; y++) {
                                    areacity += areacitys[y].city+'.';
                                    pricescity[same][i][areacitys[y].city] = areacitys[y].avg;
                                }
                            }
                        } 
                    }else{
                        pricescity[same][i] = 0;
                    }
                }
            }

            areacity = areacity.substring(0,areacity.length-1);
            areacity = areacity.split('.');
            var zsareacity = [];
            for (var i = 0; i < areacity.length; i++) {
                var y = 0;
                if(zsareacity.length == 0){
                    zsareacity[0] = areacity[i];
                }else{
                    for (var x = 0; x < zsareacity.length; x++) {
                        if(areacity[i] != zsareacity[x]){
                            y++;
                        }
                        if(y == zsareacity.length){
                            zsareacity[zsareacity.length] = areacity[i];
                        }
                            
                    }
                }
            }
            return zsareacity;
        }

        function searchhistoryorder(){
            var key_name = $('#key_name').val();
            var key_area = $('#key_area').val();
            var key_time1 = $('#key_time1').val();
            var key_time2 = $('#key_time2').val();
            $.getJSON('/com/order_index_search.php',{area:key_area,name:key_name,time1:key_time1,time2:key_time2,userid:user.userid},function(json){
                $('#history_order_contents').html(''); 
                if(json){
                    var history_order = '';
                    for (var i = 0; i < json.length; i++) {
                        history_order += '<div class="history_order_content"><div class="history_order_relcontent">'; 
                        history_order += '<div class="ordername">'+json[i].ordername+'</div>';   
                        history_order += '<div class="ordertime">'+makesimple(json[i].time)+'</div>'; 
                        history_order += '<input type="hidden" class="history_orderid" value="'+json[i].id+'">';
                        history_order += '<input type="hidden" class="history_orderaddress" value="'+json[i].address+'">';
                        history_order += '</div><div class="edit"><button type="button" class="history_button history_order_delete">删除</button><button type="button" class="history_button history_order_copy">另存</button></div>';   
                        history_order += '</div>';  
                    }
                    $('#history_order_contents').html(history_order); 
                }
            }); 
        }

        function showhistoryorder(json){
            // if(json[0] != undefined){
            if(json){
                var address_price = [];
                for (var i = 0; i < json.length; i++) {
                    address_price[i] = json[i].address_price; // 有可能没有
                }
                
                var pricees = [];
                var addresspricees = [];
                for (var i = 0; i < address_price.length; i++) {
                    // 必须做判断，否则split出错
                    if (address_price[i]) {
                        address_price[i] = address_price[i].split(',');
                        pricees[i] = [];
                        for (var x = 0; x < address_price[i].length; x++) {
                            address_price[i][x] = address_price[i][x].split(':');
                            pricees[i][address_price[i][x][0]] = address_price[i][x][1];
                            addresspricees[x] = address_price[i][x][0];
                        }
                    }
                }
            }
            var order_content = '';
            for (var i = 0; i < json.length; i++) {
                var attr = attributes_show(json[i]);
                order_content += '<div class="table">';
                order_content += '<input type="hidden" name="id" class="id"  value="'+json[i].id+'">';
                order_content += '<div class="table_order">'+(1+i)+'</div>';
                order_content += '<div class="table_content">';
                order_content += '<div class="table_row1_clos1">';
                order_content += '<div class="tree_name">'+json[i].name+'</div>';
                order_content += '<div class="tree_number">'+json[i].count+json[i].unit+'</div>';
                order_content += '</div>';
                order_content += '<div class="table_row1_clos2">';
                if(json[0].address_price){
                    for (var x = 0; x < addresspricees.length; x++) {
                        order_content += '<div class="table_row1_clos2_data">';
                        order_content += '<div class="addressprice_address">'+addresspricees[x]+'</div>';
                        order_content += '<td class="addressprice_price">'+pricees[i][addresspricees[x]]+'</td>';
                        order_content += '</div>';
                    }
                }
                order_content += '</div>';
                order_content += '<div class="table_row2">'+attr+'</div>';
                order_content += '</div>';
                order_content += '</div>';
            }
            $('#history_order_content_order').html();
            $('#history_order_content_order').html(order_content);
        }

        function copyhistory(orderid){
            addressprice = [];
            historybutn = 0;
            $.getJSON('/com/order_temp_deletepc.php',{userid:user.userid,order:'-1'},function(json){
            });
            $.getJSON('/com/order_search.php',{orderid:orderid,userid:user.userid},function(json){
                var history_datas = JSON.stringify(json);
                $.getJSON('/com/order_temp_adds.php',{data:history_datas},function(json){
                });
                data = [];
                provinces = [];
                addressprice = [];
                for (var x = 0; x < json.length; x++) {
                    data[x] = {};
                    for (var key in json[x]) {
                        var dictionaryattributes = ['trunk_diameter','ground_diameter','pot_diameter','crown','plant_height','branch_length','bough_length','branch_point_height','branch_number','bough_number',"age",'plant_height_cm','crown_cm','substrate'];
                        for (var i = 0; i < dictionaryattributes.length; i++) {
                            
                            if(key == dictionaryattributes[i]){
                                data[x][key] = json[x][key].split(',');
                                var attr = attributes_show(json[x]);
                            }
                        }
                    }
                    data[x]['id'] = json[x]['id'];
                    data[x]['name'] = json[x]['name'];
                    data[x]['count'] = json[x]['count'];
                    data[x]['type'] = json[x]['type'];
                    data[x]['typename'] = json[x]['typename'];
                    data[x]['unit'] = json[x]['unit'];
                    data[x]['userid'] = json[x]['userid'];
                }
                datan = data.length;
                $.getJSON('/com/search_price_batch.php',{data:JSON.stringify(data)},function(json){
                    for (var i = 0; i < json.length; i++) {
                        provinces[i] = [];
                        addressprice[i] = {};
                        for (var y = 0; y < data.length; y++) {
                            if(data[y].id == json[i].id){
                                addressprice[i].id = json[i].id;
                                if(json[i].price){
                                    var p = 0;
                                    addressprice[i].price = [];
                                    for (var z = 0; z < json[i].price.length; z++) {
                                        // if(json[i].price[z].total >= data[y].count){
                                            addressprice[i].price[p] = json[i].price[z];
                                            provinces[i][p] = json[i].price[z].province;
                                            p++;
                                        // }
                                    }
                                }else{
                                    addressprice[i].price = [];
                                    provinces[i] = '';
                                }
                            }
                        }
                    }
                    var haves = [''];
                    for (var x = 0; x < provinces.length; x++) {
                        for (var z = 0; z < provinces[x].length; z++) {
                            var y = 0;
                            for (var i = 0; i < haves.length; i++) {
                                if(haves[i] != provinces[x][z]){
                                    ++y;
                                }
                                if(y == haves.length){
                                    haves[haves.length] = provinces[x][z];
                                }
                            }
                        }
                    }   
                    console.log(addressprice,provinces,haves);
                    // // 显示交集省份
                    $('.provinces_name').hide();
                    $('.tree_arrive_address_citys').html('');
                    $('input[type="checkbox"]').prop("checked",false);
                    cities = '';
                    fatherprivious = '';
                    pricescity = [];
                    sohard = [];
                    for (var i = 0; i < haves.length; i++) {
                        $('#tree_origin_name input[type="checkbox"][value="'+haves[i]+'"]').parent().show();
                    }   
                    $('#label1').css('background','#ccc');
                    $('#label2').css('background','#fff');
                    $('#history_orders').hide();
                    $('#current_order').show();
                    showprice();
                    $('#history_order_content_order').html('');
                    $('#history_order_content_orders').hide();
                    $('#history_order_content_orders input').val('');
                });
            });
        }

        /***********按钮操作**************/
        function bindButtonEvent(){

            // 显示录入框
            $('#input_order').click(function(){
                $('#attributein').show();
                $('#attributein input:text:first').focus();
            });

            // 隐藏录入框
            $('#hidden_attributein').click(function(){
                $('#attributein').hide();
                editen = -1;
                $('#attributein input').val('');
                hideattribute();
                $('#add').html('添加');
                $('#reset').html('清空');
            });
            
            // 展示历史订单详情
            $('#history_order_contents').on('click','.history_order_relcontent',function(){
                $('.history_order_content').css('background','#fff');
                $(this).parents('.history_order_content').css('background','#ddd');
                $('#history_order_content_orders').show();
                var orderid = $(this).find('.history_orderid').val();
                var ordername = $(this).find('.ordername').html();
                console.log(ordername);
                $('#history_ordername_title').html(ordername);
                var horderaddress = $(this).find('.history_orderaddress').val();
                console.log(horderaddress);
                if((horderaddress != 0) && (horderaddress != 'null')){
                    var orderaddress = horderaddress.split('.');
                    if(orderaddress[0] != 'null'){
                        $('#history_order_content_orders input[name="province"]').val(orderaddress[0]);
                    }else{
                        $('#history_order_content_orders input[name="province"]').val('省');
                    }
                    if(orderaddress[1] != 'null'){
                        $('#history_order_content_orders input[name="city"]').val(orderaddress[1]); 
                    }else{
                        $('#history_order_content_orders input[name="city"]').val('市');
                    }
                    if(orderaddress[2] != 'null'){
                        $('#history_order_content_orders input[name="area"]').val(orderaddress[2]); 
                    }else{
                        $('#history_order_content_orders input[name="area"]').val('县'); 
                    }
                }else{
                    $('#history_order_content_orders input[name="province"]').val('省');
                    $('#history_order_content_orders input[name="city"]').val('市');
                    $('#history_order_content_orders input[name="area"]').val('县');
                }
                $.getJSON('/com/order_search.php',{orderid:orderid,userid:user.userid},function(json){
                    showhistoryorder(json);
                });
            });

            // 删除订单
            $('#history_order_contents').on("click",'.history_order_delete',function(){
                var orderid = $(this).parents('.history_order_content').find('.history_orderid').val();
                var hidden = $(this);
                var edit = confirm('你确定要删除吗?');
                if(edit == true){
                    $.get('/com/order_delete.php',{orderid:orderid,userid:user.userid},function(json){
                        hidden.parents('.history_order_content').hide();
                    });
                }else{
                    return false;
                }
            });

            

            // 使用历史订单
            $('#history_order_contents').on("click",'.history_order_copy',function(){
                var orderid = $(this).parents('.history_order_content').find('.history_orderid').val();
                copyhistory(orderid);
            });

            // 添加
            $('#add').click(function(){
                toadd();
                var scrollheight = document.documentElement.scrollHeight;
                // 跳至底部
                $("html,body").animate({scrollTop:scrollheight}, 10);
            });

            // 搜索
            $('#key_name').change(function(){
                searchhistoryorder();
            });
            $('#key_area').change(function(){
                searchhistoryorder();
            });
            $('#key_time1').change(function(){
                var key_time1 = $('#key_time1').val();
                var key_time2 = $('#key_time2').val();
                if(key_time1 && key_time2){
                    searchhistoryorder();
                }
            });
            $('#key_time2').change(function(){
                var key_time1 = $('#key_time1').val();
                var key_time2 = $('#key_time2').val();
                if(key_time1 && key_time2){
                    searchhistoryorder();
                }
            });

            // 重置及删除
            $('#reset').click(function(){
                reset();
            });
            var snake = -1;
            // 修改
            $('#order_table').on("click",".table",function(){
                $(this).css('background','#eee');
                $(this).siblings().css('background','transparent');
                dataid = $(this).find('.id').val();
                for (var i = 0; i < data.length; i++) {
                    if(data[i].id == dataid){
                        editen = i;
                    }
                }
                if(snake == editen){
                    showattributeindex();
                }else{
                    snake = editen;
                    attributeedite();
                }
            });

            $('#search_reset').click(function(){
                $('#history input').val('');
                searchhistoryorder();
            })

            // 省份价格
            $("#tree_origin_name").change(function() {
                showprice();
            });

            // 提交订单
            $('#deal_budget').click(function(){
                $('.alertordername').show();
                $('#order_name').focus();
                button_ordernumber = 1;
            });
            $('#deal_purchase').click(function(){
                $('.alertordername').show();
                $('#order_name').focus();
                button_ordernumber = 2;
            });
            $('#join_order').click(function(){
                $('.alertordername').show();
                $('#order_name').focus();
                button_ordernumber = 3;
            });
            $('#order_name_button_reset').click(function(){
                $('.alertordername').hide();
                $('#order_name').val('');
                button_ordernumber = 0;
            })
            
            // 填写订单名提交
            $('#order_name_button').click(function(){
                final_deal();
                var order_name = $('#order_name').val();
                $('.alertordername').hide();
                if(button_ordernumber == 1){
                    window.location = '/excel.php?uid='+user.userid+'&data='+datas+'&addressprices='+addresspricess+'&useraddress='+detailed_address+'&ordername='+order_name;
                    button_ordernumber = 0;
                }else if(button_ordernumber == 2){
                    window.location = '/require_list.php?uid='+user.userid+'&data='+datas+'&addressprices='+addresspricess+'&useraddress='+detailed_address+'&ordername='+order_name;
                    button_ordernumber = 0;
                }else if(button_ordernumber == 3){
                    $.get('/com/order_add.php',{uid:user.userid, data:datas, addressprices:addresspricess,useraddress:detailed_address,ordername:order_name},function(json){    
                        loadHistoryOrder();
                        alert('成功存入我的清单!');
                        data = [];
                        addressprice = [];
                        $('input[type="checkbox"]').prop("checked",false);
                        $('#tree_arrive_address_city').html('');
                        $('.provinces_name').hide();
                        cities = '';
                        fatherprivious = '';
                        pricescity = [];
                        sohard = [];
                        showprice();
                    });
                    button_ordernumber = 0;
                }
            });

            $('#label1').click(function(){
                $('#label1').css('background','#ccc');
                $('#label2').css('background','#fff');
                $('#history_orders').hide();
                $('#current_order').show();
            });

            $('#label2').click(function(){
                $('#label2').css('background','#ccc');
                $('#label1').css('background','#fff');
                $('#current_order').hide();
                $('#history_orders').show();
            });
        }

        function getcookie(name){//获取指定名称的cookie的值
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }   

        var user = getcookie('user2');

        if (user) {
            user = JSON.parse(user);
                bindButtonEvent();
                loaddictionary();
                loadHistoryData();
                bindInputEvent();
                loadHistoryOrder();
                loadprovincesaddress();
        }else{
            window.location.replace('m.php');
        }
        
    </script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
function getTitle () {
    return '找树网 预算采购入口';
}
function getImageUrl(){
    return 'http://cnzhaoshu.com/headimg/96/' + user.userid + '.jpg';
}

function getLink(){
    return window.location.href;
} 

function getDescription () {
    return '大数据支撑预算、手机生成采购单！';
}

function prepareShare () {
    // 在这里调用 API
    wx.onMenuShareAppMessage({
      title: getTitle(),
      desc: getDescription(),
      link: getLink(),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareTimeline({
      title: getTitle() + "\n" +getDescription(),
      link: getLink(),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareQQ({
      title: getTitle(),
      desc: getDescription(),
      link: getLink(),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareWeibo({
      title: getTitle(),
      desc: getDescription(),
      link: getLink(),
      imgUrl: getImageUrl()
    });
}

function setWechatJSSDK(res){
    wx.config({
        debug: false,
        appId: res.appId,
        timestamp: res.timestamp,
        nonceStr: res.nonceStr,
        signature: res.signature,
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareQZone',
            'onMenuShareWeibo',
            'hideMenuItems'
        ]
    });

    wx.ready(function () {
      wx.hideMenuItems({
          menuList: ['menuItem:copyUrl'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
      });

      prepareShare();
    });
}

function loadWechatJSSDK() {
    $.getJSON('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function (res) {
      setWechatJSSDK(res);
    });
}
setTimeout(loadWechatJSSDK, 500);

</script>
</body>
</html>