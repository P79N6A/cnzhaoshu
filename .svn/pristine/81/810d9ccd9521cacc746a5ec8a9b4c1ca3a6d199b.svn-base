<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>我的交易</title>
    <link rel="stylesheet" href="./css/weui.min.css"/>
    <link rel="stylesheet" href="./css/example.css"/>
    <style type="text/css">
        #tenderfoot{
            width: 100%; 
            float: left; 
            position: fixed; 
            z-index: 300; 
            bottom: 0px; 
            left: 0px;
            background: #fff;
            height: 48px;
            text-align: center;
            display: none;
        }
        .getphoto{
            width: 21%; 
            float: left; 
            line-height: 36px;
            color:#1AAD19;
            margin-top:7px;
            padding:0 2%;
        }   
        .sendmessage{
            width: 21%; 
            float: left;
            color:#1AAD19;
            line-height: 36px;
            margin-top:7px;
            padding:0 2%;
        }
        .changetime{
            width: 21%; 
            float: left;
            color:#1AAD19;
            line-height: 36px;
            margin-top:7px;
            padding:0 2%;
        }
        .getexcel{
            width: 21%; 
            float: left;
            color:#1AAD19;
            line-height: 36px;
            margin-top:7px;
            padding:0 2%;
        }
        .order{
            float:left;
            width:100%;
            margin-bottom: 10px;
        }
        #screenlist .ordertitle{
            width:96%;
            background: #fff;
            border-radius: 3px;
            padding-left: 2%;
            float:left;
        }
        .open .showone_title{
            background-color: #eee;
        }
        #screenlist{
            margin-bottom: 50px;
            float: left;
            width:100%;
        }
        .order_ordername{
            float: left;
            width:70%;
            overflow:hidden;
        }
        .order_state{
            float: left;
            width:30%;
            height: 36px;
            line-height: 36px;
            margin:7px 0;
            text-align: center;
        }
        .check .order_state{
            border-radius: 5px;
            color: #1AAD19;
        }
        .allorder{
            float: left;
            width: 100%;
            -webkit-overflow-scrolling:touch;
        }
        .showone{
            float: left;
            width:100%;
            border-bottom: 1px solid #eee;
            padding:5px 0;
        }
        .showone_title{
            width:100%;
            float: left;
        }
        .row1{
            float: left;
            width:100%;
        }
        .showone_order{
            width:8%;
            margin-left: 2%;
            float: left;
            line-height: 27px;
        }
        .showone_name{
            width:40%;
            float: left;
            line-height: 27px;
        }
        .showone_number{
            width:30%;
            float: left;
            line-height: 27px;
            font-size: 14px;
        }
        .row2{
            float: left;
            width:90%;
            margin-left: 10%;
            line-height: 18px;
            font-size: 14px;
        }
        .row3{
            float: left;
            width:90%;
            margin-left: 10%;
            font-size: 14px;
        }
        .row4{
            float: left;
            margin-top: 5px;
            padding:3px 0;
            width:89%;
            margin-left: 10%;
            border:1px solid #eee;
            display: none;
            font-size: 14px;
        }
        .bids{
            width:100%;
            float:left;
            margin:5px 0;
        }
        .image{
            width:25%;
            height:90px;
            margin: 0 1%;
            float:left;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            overflow: hidden;
        }
        .bidinfo{
            width:40%;
            margin:0 1%;
            height:90px;
            float:left;
        }
        .bidinfo_name{
            width:100%;
            line-height: 16px;
            float:left;
        }
        .bidinfo_phone{
            width:100%;
            line-height: 18px;
            float:left;
        }
        .bidinfo_price,.bidinfo_count{
            width:90%;
            line-height: 17px;
            float:left;
            text-align: right;
            padding-right:10%;
        }
        .button{
            width:31%;
            height:90px;
            float:left;
        }
        .besupplier,.paydeposit,.payfullamount,.receipt,.refund,.bid,.notreceipt,.over,.consult,.over,.overreceipt{
            width:90%;
            float:left;
            margin-top: 5px;
            padding:5px 3px;
            font-size: 15px;
            border-radius:3px;
            background:#1AAD19;
            color:#fff;
            text-align: center;
        }
        .delete{
            width:90%;
            float:left;
            margin-top: 15px;
            padding:5px 3px;
            font-size: 14px;
            border-radius:3px;
            background:#1AAD19;
            color:#fff;
            text-align: center;
        }
        .bigimages{
            z-index: 5000;
            background: #fff;
            display: none;
            left:0;
            top:0;
            position: fixed;
        }
        #bigimages{
            width:100%;
            height:100%;
            overflow-y: auto;
        }
        .bigimage{
            width:100%;
            margin-top: 10px;
        }
        .order_state0{
            float: left;
            width:30%;
            height: 40px;
            text-align: center;
        }
        .supplierinfo,.blacksupplierinfo{
            float: left;
            width:98%;
            line-height: 1.4;
            background: #fff;
            padding: 3px 1%;
            margin:2px 0;
            border-radius: 4px;
            position: relative;
        }
        .supplierinfo_address,.blacksupplierinfo_address{
            line-height: 1.3;
            width:65%;
            float: left;
        }
        .supplierinfo_name,.blacksupplierinfo_name{
            line-height: 1.1;
            width:65%;
            float: left;
        }
        .supplierinfo_phone,.blacksupplierinfo_phone{
            line-height: 1.8;
            width:65%;
            float: left;
        }
        .supplierinfo_hit,.supplierinfo_cancel,.blacksupplierinfo_hit,.blacksupplierinfo_cancel{
            width:25%;
            float: left;
            background: #1AAD19;
            text-align: center;
            color:#fff;
            border-radius: 4px;
            padding: 4px 0;
            bottom: 8px;
            position: absolute;
            left:70%;
        }
        .supplierimg,.blacksupplierimg{
            width:30%;
            float: left;
            margin: 0 2%;
            border-radius: 50%;
            overflow:hidden;
        }
        #history_orders{
            width:100%;
            float: left;
            margin-bottom: 10px;
        }
        #history{
            float:left;
            width:100%;
            font-size: 16px;
        }
        .search_titel{
            float:left;
            width:100%;
            background:#fff;
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
        }
        .name{
           float:left;
           height:35px;
           line-height:35px;
           margin-top: 5px;
           font-size: 18px;
           width:13%;
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
        .history_title{
            width:100%;
            line-height: 30px;
            font-size: 15px;
            text-align: center;
            margin-top: 10px;
            float: left;
            color:#999999;
        }
        .title_ordername{
            width:37%;
            float: left;
        }
        .title_ordertime{
            width:28%;
            float: left;
        }
        .title_edit{
            width:35%;
            float: left;
        }
        #history_order_contents{
            width:100%;
            float: left;
            overflow-y: auto;
            background: #fff;
        } 
        #history_order_content_orders{
            width:98%;
            padding: 10px 1%;
            float:left;
            overflow-y: auto;
        }
        .history_order_content_orderdetail{
            display:none;
            background: #fff;
            position: fixed;
            width:100%;
            z-index: 999;
            left:0;
            top:0;
        }
        .history_order_content{
            width:96%;
            font-size: 16px;
            float: left;
            text-align: center;
            border-bottom: 1px solid #ddd;
            margin: 3px 1% 3px 3%;
        }
        .history_order_relcontent{
            float:left;
            width:65%;
            border-radius: 1px;
        }
        .ordername{
            width:57%;
            float: left;
            line-height: 32px;
            font-size: 15px;
            text-align: left;
            height:32px;
            overflow: hidden;
        }
        .ordertime{
            width:43%;
            float: left;
            line-height: 32px;
        }
        .edit{
            width:35%;
            float: left;
            line-height: 32px;
        }
        .history_button{
            border: 1px solid #fff;
            border-radius: 4px;
            box-sizing: border-box;
            display: inline-block;
            font-size: 13px;
            font-weight: normal;
            background-color: #1AAD19;
            color: #fff;
            height:30px;
            width:47%;
        }
        .page__hd{
            padding: 10px 30px;
        }
        .page__title{
            text-align: center;
        }
        .arriveaddressdiv{
            float: left; 
            width: 85%; 
            font-size: 18px;
            padding: 2px 5% 10px 10%;
            margin-bottom: 15px;
        }
        .arriveaddresstitle{
            float: left; 
            width: 30%;
        }
        #arriveaddress{
            float: left; 
            width: 70%;
            overflow: hidden;
        }
        #history_ordername_title{
            float:left;
            width:70%;
            text-align: center;
            padding: 0 15%;
            font-size: 20px;
            border-radius:4px;
            color:#999999;
        }
        .table{
            border-bottom:1px dashed #ddd;
            float: left;
            width:100%;
            color:#000;
            padding-bottom: 2px;
            margin-bottom:2px;
        }
        .table_order{
            width:10%;
            float:left;
            text-align: center;
            line-height: 28px;
            color: #bbb;
        }
        .table_content{
            width:89%;
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
        .table_row2,.table_row3{
            width:100%;
            float:left;
            line-height: 20px;
            margin: 0px 0px 2px 0px;
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
        #alertordername,#alerttime{
            z-index:9999;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color: rgba(0, 0, 0, 0.4);  
            display:none;
        }

        #alertinfo{
            position:absolute;
            bottom:10px;
            left:0%;
            width:99%;
            height:230px;
            border-radius:5px;
            border:solid 2px #aaa;
            background-color:#eee;
            box-shadow: 0 0 10px #666;
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
            height: 30px;
            line-height: 1.3;
            padding: 6px 8px;
            vertical-align: middle;
            margin:10px auto;
            width:90%;
        }
        #tree_arrive_address_name{
            float: left;
            margin-left:2.5%;
            width:96%;
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
        .order_name_button_reset,#order_name_button,.order_time_button_reset,#order_time_button{
            margin: 3% 0 3% 22%;
        }
        #add,#reset{
            margin:5px 0 5px 23%;
        }
        .bid_content,.bid_contents,.bid_contentss{
            width:98%;
            float: left;
            height: auto;
            margin: 7px 1% 0;
            background: #fff;
            border-radius: 4px;
        }
        .bid_content_row1{
            width:100%;
            float: left;
            height:25px;
            line-height: 25px;
            font-size: 14px;
        }
        .bid_content_row{
            width:100%;
            float: left;
            height:25px;
            line-height: 25px;
        }
        .bid_content_row0{
            width:100%;
            float: left;
            height:32px;
            line-height: 32px;
            border-bottom: 1px dashed #ddd;
        }
        .bid_content_row3{
            width:100%;
            float: left;
            height:32px;
            text-align: center;
        }
        .bid_content_price,.bid_content_number{
            width:48%;
            float: left;
            margin-left: 2%;
        }
        .bid_content_name{
            width:50%;
            float: left;
            margin-left: 2%;
            font-size: 16px;
        }
        .bid_content_result{
            float: right;
            color:#a6a;
            text-align: right;
            font-size: 14px;
            margin-right: 2%;
        }
        .bid_content_row2{
            width:96%;
            float: left;
            margin-left: 2%;
            line-height: 25px;
            font-size: 14px;
        }
        .orderinfos{
            float: left;
            width:94%;
            padding: 0 3%;
            color:#999;
            background: #fff;
            border-radius: 4px;
            line-height: 30px;
        }
        .orderinfos_ordername{
            float: left;
            width:100%;
            line-height: 1.5;
        }
        .orderinfos_username{
            line-height: 25px;
            float: left;
            width:60%;
        }
        .orderinfos_userphone{
            line-height: 25px;
            float: left;
            width:40%;
            height:25px;
        }
        .orderinfos_info{
            line-height: 25px;
            float: left;
            width:90%;
            height:25px;
            overflow: hidden;
        }
        .checked{
            color:#1AAD19;
        }
        .topbutton{
            position: relative;
            padding: 13px 0;
            text-align: center;
            flex: 1;
        }
        .headtitle{
            display: flex;
            position: absolute;
            z-index: 500;
            top: 0;
            width: 100%;
            background: #fff;
        }
        #bidhistory_info,#supplierlist,#customerlist{
            padding-top: 50px;
            -webkit-overflow-scrolling:touch;
        }
        #order_table{
            width: 96%;
            float: left;
            margin: 2px 2%;
        }
        #order_table .on .ordertitle{
            color:#1AAD19;
        }
        #order_table .ordertitle{
            width:96%;
            line-height:50px;
            background: #fff;
            border-radius: 3px;
            padding-left: 2%;
            padding-right: 1%;
            float:left;
            margin-bottom: 2px;
        }
        .createneworder{
            width: 60%;
            height: 40px;
            margin: 7px 20% 7px;
            line-height: 40px;
            border-radius: 4px;
            float: right;
            text-align: center;
            background-color: #1AAD19;
            color: #ffffff;
        }
        .join_order{
            width:100%;
            height:45px;
            margin:10px 0 10px;
            line-height:45px;
            border-radius: 4px;
            float:left;
            text-align: center;
            background-color: #1AAD19;
            color: #ffffff;
            margin:20px 0 50px;
        }            
        .currentinfo{
            width: 100%;
            float: left;
        }
        #menu{
            z-index:999; 
            position:fixed; 
            bottom:0;
            left: 0;
            width:100%;
        }
        .menu_button {
            margin-bottom: 0;
            text-align: center;
            background-color: #fff;
            color: #1AAD19;
            float:left;
            height:50px;
            line-height: 50px;
            width:33%;
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
            max-height:300px;
            overflow-y: auto;
            -webkit-overflow-scrolling:touch;
        }
        .hidden_attributein{
            float: right;
            text-align: right;
            width: 90%;
            font-size: 30px;
            padding: 0 5%;
        }
        #attributein .weui-cell{
            padding: 8px 15px;
        }
        
        .ordertitle_ordername{
            float: left;
            width:100%;
            height: 50px;
            overflow:hidden;
        }
        .on .ordertitle_ordername{
            float: left;
            width:75%;
            height: 50px;
            overflow:hidden;
        }
        .title_delete{
            float: right;
            display: none;
        }
        .on .title_delete{
            float: right;
            width:20%;
            text-align: center;
            border-radius: 5px;
            color:#fff;
            background:#1AAD19;
            display: block;
            height: 32px;
            line-height: 32px;
            margin: 9px 0;
        }
        .ordercontent{
            display: none;
            background:#fff;
            float:left;
            margin-bottom: 10px;
            width:100%;
            overflow-y: auto;
        }
        .tree_order_address{
            padding-top: 10px;
            font-size: 16px;
            float: left;
            width:100%;
        }
        .tree_order_lable{
            font-size: 18px;
            float: left;
        }

        .tree_origin_name{
            width:100%;
            float: left;
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
        .tenderuserinfo{
            float: left;
            width: 100%;
            height: auto;
        }
        .historybidorder{
            float: left;
            margin-left: 10%;
            font-size: 15px;
            line-height: 20px;
            width:89%;
            color:#999;
        }
        .historybidorder_one{
            float:left;
            width:100%;
            margin-top: 4px;
        }
        .historybidorder_one_name{
            float:left;
            width:60%;
            overflow:hidden;
            height:20px;
        }
        .historybidorder_one_phone{
            float:left;
            width:50%;
            text-align: left;
        }
        .historybidorder_one_price{
            float:left;
            width:35%;
            text-align: right;
        }
        .historybidorder_one_evaluate{
            float: right;
            width: 20%;
            margin-right: 5%;
            text-align: center;
            border: 1px solid;
            border-radius: 10px;
            color: #1AAD19;
        }
        .marking {
            display: inline-block;
            padding: .15em .4em;
            min-width: 8px;
            border-radius: 18px;
            background-color: #F43530;
            color: #FFFFFF;
            line-height: 1.2;
            text-align: center;
            font-size: 12px;
            vertical-align: middle;
        }
        .bid_number {
            display: inline-block;
            padding: .15em .4em;
            min-width: 8px;
            border-radius: 18px;
            background-color: #F43530;
            color: #FFFFFF;
            line-height: 1.2;
            text-align: center;
            font-size: 12px;
            vertical-align: middle;
        }
        .order_ordername_name,.order_ordername_time{
            width:100%;
        }
        .alertrow1{
            float:left;
            width:100%;
        }
        .alert_head{
            width:50%;
            float: left;
            height:35px;
            line-height: 35px;
            font-size: 20px;
            padding-left:25%;
            text-align: center;
            margin: 5px 0px;
        }
        .closealertphone{
            width:10%;
            float: left;
            padding-left: 15%;
            font-size: 25px;
        }
        .alertinput2{
            float: left;
            width: 100%;
            margin: 20px 0;
        }
        .alerttitle{
            width:30%;
            float: left;
            padding-left: 10%;
            font-size: 18px;
            line-height: 1.4;
        }
        .alertcontent{
            width:50%;
            float: left;
            border: 0;
            outline: 0;
            -webkit-appearance: none;
            background-color: transparent;
            font-size: 18px;
            line-height: 1.4;
        }
        .buttonbottom{
            float: left;
            width: 100%;
        }
        .phone_button_reset {
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
            background:#1AAD19;
            color:#fff;
            width:20%;
            float: left;
            margin-left:25%;
            margin-top:15px;
            margin-bottom:15px;
        }
        #phone_button{
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
            background:#1AAD19;
            color:#fff;
            width:20%;
            float: right;
            margin-right:25%;
            margin-top:15px;
            margin-bottom:15px;
        }
        #alertuserphone {
            z-index:10000;
            position:fixed;
            bottom:0;
            left:0%;
            width:99%;
            border-radius:5px;
            border:solid 2px #aaa;
            background-color:#eee;
            display:none;
            box-shadow: 0 0 10px #666;
        }
        .bid_serial_number{
            width:90%;
            float: left;
            margin-left: 2%;
        }
        #process{
            position: fixed;
            z-index: 1000;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background:rgba(0, 0, 0, 0.6);
            display: none;
        }
        #alert{
            width:96%;
            margin:10px 2% 10px;
            background-color: #fff;
            padding-bottom: 30px;
            position: fixed;
            bottom: 10px;
            border-radius: 3px;
            overflow-y: auto;
            max-height:400px;
            -webkit-overflow-scrolling:touch;
        }
        .line{
            width:40px;
            min-height:60px;
            border-right:1px solid #999;
            position: relative;
            float: left;
        }
        .yuan{
            position: absolute;
            width: 10px;
            height: 10px;
            float: right;
            border-radius: 50%;
            margin-left: 35px;
            background-color: #1AAD19;
        }
        .processalerttitle{
            width:100%;
            height:50px;
            text-align: center;
            font-size: 20px;
            color: #999;
            line-height: 50px;
        }
        .boxinfo{
            float: left;
            width:200px;
            margin-left: 10px;
            height:60px;
        }
        .box{
            width:100%;
            min-height:60px;
            font-size: 14px;
            line-height: 1.3;
        }
        .alertstop{
            position: fixed;
            z-index: 20;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background:rgba(0, 0, 0, 0.6);
            display: none;
        }
        #alertinfos{
            position: fixed;
            z-index: 30;
            width: 76%;
            height:200px;
            left:10%;
            bottom:15px;
            background-color: #fff;
            padding: 2%;
            text-align: left;
            border-radius: 4px;
            color:#000;
            font-size: 17px;
        }
        #remark{
            width:94%;
            padding: 3%;
            font-size: 16px;
            line-height: 1.3;
            height:70%;
            border: 0;
            resize: none;
        }
        .resets,.uploads{
            width:30%;
            margin:5px 10%;
            padding: 5px 0;
            float: left;
            font-size: 16px;
            background: #1AAD19;
            border-radius: 3px;
            text-align: center;
            color: #fff;
        }
        .hide{
            display:none;
        }
        .colorinfo{
            color:#8cea00;
        }
        #hideshow{
            z-index: 1000;
            position: fixed;
            left: 5px;
            top: 5px;
            width: 40px;
            height: 40px;
            background-image:url(./img/fanhui.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 40px;
            border:2px solid #fff;
        }
        #homeindex{
            z-index: 10;
            position: fixed;
            left: 5px;
            top: 5px;
            width: 40px;
            height: 40px;
            background-image:url(./img/fanhui.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 40px;
            border:2px solid #fff;
        }
        .evaluate_content{
            height:370px;
            width:96%; 
            margin:0 auto;
            z-index: 1100;
            top:0;
            left: 0;
            background: #fff;
            position: fixed;
            display: none;
            padding: 10px 2%;
        }
        .evaluate_content h3{
            line-height: 40px;
            height: 40px;
            text-align: center;
            background: #f8f8f8;
            font-size: 20px;
            color: #666;
        }
        .evaluate_contents{
            padding-top:10px;
            height:220px;
        }
        .evaluate_row1_stars{
            width:100%;
            float: left;
        }
        #evaluate_upload{
            width: 25%;
            height: 40px;
            border-radius: 5px;
            background: #1AAD19;
            text-align: center;
            line-height: 40px;
            float: left;
            margin-left: 14%;
            color: #fff;
        }
        #evaluate_reset{
            width: 25%;
            height: 40px;
            border-radius: 5px;
            background: #1AAD19;
            text-align: center;
            line-height: 40px;
            float: left;
            margin-left: 18%;
            color: #fff;
        }
        .star_l{
            float:left;
            width:25%;
        }
        .evaluate_row1_starsshow{
            float:left;
            width:60%;
            min-width: 130px;
        }
        #evaluate_text{
            resize: none;
            border: solid 1px #ccc;
            height:130px;
            width:90%;
            padding: 10px 4%;
            font-size: 15px;
            margin: 10px 0;
            border-radius: 5px;
            float: left;
        }
        .showstar{
            width:24px;
            height:24px;
            float: left;
            background-image:url(./img/star.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .starover{
            width:24px;
            height:24px;
            float: left;
            background-image:url(./img/overstar.gif);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .button_paydown,.button_payfull,.button_applyrefund,.button_detail,.button_evaluate,.button_receipt,.button_refunding,.button_notreceipt,.button_handing,.button_over,.button_retreat,.button_notretreat,.button_applydeposit,.button_agreepay,.button_disagreepay,.button_delivery,.disagree,.agree,.bid_content_evaluate,.bid_detail{
            float: right;
            display: inline-block;
            padding: .15em .4em;
            min-width: 8px;
            border-radius: 29px;
            background-color: #fff;
            color: #000;
            line-height: 1.2;
            text-align: center;
            border:1px solid #bbb;
            font-size: 15px;
            margin:2px 1.2%;
            vertical-align: middle;
        }
        .buy_onedatainfo,.sell_onedatainfo{
            width: 95%;
            margin:0 1% 6px;
            float: left;
            padding: 3px 1% 3px 2%;
            border-radius: 2px;
            background:#eee;
            -webkit-overflow-scrolling:touch;
        }
        #orderinfo{
            width: 100%;
            overflow-y: auto;
            padding-top: 55px;
        }
        .headtitle1{
            display: flex;
            position: absolute;
            z-index: 500;
            top: 0;
            width: 85%;
            background: #fff;
            padding-left: 15%;
        }
        .money_operation{
            width: 80%;
            margin: 80px 10% 20px;
            text-align: center;
            float: left;
            font-size: 20px;
        }
        .money_submit{
            font-size: 20px;
            text-align: center;
            text-decoration: none;
            color: #FFFFFF;
            height: 22px;
            line-height: 22px;
            border-radius: 4px;
            background-color: #1AAD19;
            padding: 10px;
            margin-top: 130px;
        }
        .money_detail{
            width: 20%;
            height: 30px;
            margin: 13px 0 10px 80%;
            color: #1AAD19;
            font-size: 20px;
            text-align: center;
            float: left;
        }
        .money_bigbackground{
            width:100%;
            position: fixed;
            z-index: 100;
            top: 0px;
            left: 0px;
            background-color: #fff;
            overflow-y: auto;
            -webkit-overflow-scrolling:touch;
            display: none;
        }
        #money_bigbackground{
            width:90%;
            padding: 50px 5% 20px;
            float: left;
        }
        .money_onedata{
            width:100%;
            float: left;
            border-bottom: 1px dashed #eee;
        }
        .money_time{
            font-size: 15px;
            width:100%;
            float: left;
        }
        .money_money{
            font-size: 16px;
            width:100%;
            float: left;
        }
        .money_row1{
            width:70%;
            float: left;
            text-align: left;
        }
        .money_row2{
            color: red;
            width:30%;
            float: right;
            text-align: right;
        }
        .money_row3{
            width:30%;
            float: right;
            text-align: right;
        }
        .mywallet{
            width:100%;
            float: left;
        }
        .hd_title{
            font-size: 20px;
            font-weight: 400;
            float: left;
            width:40%;
            margin-left: 30%;
            text-align:center;
        }
        .clean{
            font-size: 18px;
            float: right;
            width:20%;
            text-align: center;
            margin-top: 5px;
            color:#1AAD19;
        }
    </style>
</head>
<body ontouchstart>
    <div class="evaluate_content">
        <h3>我要评论</h3>
        <div class="evaluate_contents">
            <div class="evaluate_row1_stars">
                <span class="star_l">满意度：</span>
                <div class="evaluate_row1_starsshow">
                    <div class="showstar star1" state="1"></div>
                    <div class="showstar star2" state="2"></div>
                    <div class="showstar star3" state="3"></div>
                    <div class="showstar star4" state="4"></div>
                    <div class="showstar star5" state="5"></div>
                </div>
            </div>                        
            <textarea id="evaluate_text" placeholder="填写您的评价(不得超过250字)" type="text" maxlength="250"></textarea>
        </div>
        <div id="evaluate_reset">取消</div>       
        <div id="evaluate_upload">提交</div>       
    </div>
    <div id="process">
        <div id="alert">
            <div class="processalerttitle">订单进程</div>
        </div>
    </div>
    <div id="homeindex">
    </div>
    <div class="alertstop">
        <div id="alertinfos">
            <textarea id="remark" placeholder="填写您的退款理由"></textarea>
            <div class="resets">取消</div>
            <div class="uploads">提交</div>
        </div>
    </div>
    <div class="container" id="container">        
    </div>
    <script id="dot_screen_order" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div id="{{=it[i].id}}" class="order" send_msg="{{=it[i].send_msg}}" qrcode="{{=it[i].qrcode}}"  expiration_date="{{=it[i].expiration_date}}">
                <div class="ordertitle">
                    <div class="order_ordername">
                        <div class="order_ordername_name">{{=it[i].ordername ? it[i].ordername : ''}}</div>
                        <div class="order_ordername_time">{{=shorttime(it[i].time)}}</div>                    
                    </div>
                    <div class="order_state" state="{{=tendertitlebuttonstate(it[i].review_state,it[i].tendering)}}">{{=tendertitlebutton(it[i].review_state,it[i].tendering)}}</div>
                </div>
                <div class="allorder" id="show{{=it[i].id}}">
                </div>
            </div>
        {{ } }}
    </script>
    <script id="dot_show" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="showone" id="{{=it[i].id}}">
                <div class="showone_title"  style="{{=it[i].successnum ? 'color:#E64340' : ''}}">
                    <div class="row1">
                        <div class="showone_order">{{=addone(i)}}</div>
                        <div class="showone_name">{{=it[i].name}}</div>
                        <div class="showone_number">{{=it[i].count ? it[i].count :' '}}{{=it[i].unit ? '('+it[i].unit+')' : ''}}</div>
                        <div class="bid_number" style="{{=it[i].num ? '' : 'opacity:0'}}">{{=it[i].num ? it[i].num : ''}}</div>
                    </div>
                    <div class="row2">{{=attributes_show(it[i])}}</div>
                </div>
                <div class="row4">
                </div>
            </div>
        {{ } }}
    </script>
    <script id="dot_bids" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="bids" data-userid="{{=it[i].userid}}" check="{{= (it[i].state==2) ? true : false}}">
                <div class="image" data-image="{{=it[i].image}}" style="background-image: url('./bidimage/{{=firstimage(it[i].image)}}.jpg')"></div>
                <div class="bidinfo">
                    <div class="bidinfo_name">{{=it[i].city  ? it[i].city : ''}}({{=it[i].username ? it[i].username : ''}})</div>
                    <a href="tel:{{=it[i].phone}}" class="bidinfo_phone">{{=it[i].phone ? it[i].phone : ''}}</a> 
                    <div class="bidinfo_count">{{=it[i].number}}{{=it[i].unit}}</div>
                    <div class="bidinfo_price">{{=(it[i].price/100)}}元/{{=it[i].unit}}</div>
                </div>
                <div class="button" state="{{=it[i].state}}">
                    {{? ((it[i].state == 1) && (it[i].relationshipstate == 1))}}
                        <div class="bid">中标</div>
                    {{?? it[i].state == 1}}
                        <div class="besupplier">成为供应商</div>
                    {{??}}
                    {{?}}
                    {{= (it[i].state == 1) ? '<div class="delete">删除</div>' : ''}}
                    {{= (it[i].state == 2) ? '<div class="paydeposit">付定金</div>' : ''}}
                    {{= ((it[i].state > 1) && (it[i].state < 4)) ? '<div class="payfullamount">付全款</div>' : ''}}
                    {{= ((it[i].ispay == 0) && (it[i].state == 3)) ? '<div class="refund">申请退款</div>' : ''}}
                    {{= (it[i].state == 4) ? '<div class="receipt">收货</div>' : ''}}
                    {{= (it[i].state == 4) ? '<div class="notreceipt">拒收货</div>' : ''}}
                    {{= (it[i].state == 5) ? '<div class="overreceipt">已收货</div>' : ''}}
                    {{= (it[i].state == 6) ? '<div class="consult">正在协商</div>' : ''}}
                    {{= (it[i].state == 7) ? '<div class="consult">退定金中</div>' : ''}}
                    {{= (it[i].state == 8) ? '<div class="over">交易完成</div>' : ''}}
                </div>
            </div>
        {{ } }}
    </script>
    <script id="dot_supplierlist" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="supplierinfo" data-userid="{{=it[i].supplier_id ? it[i].supplier_id : it[i].userid}}">
                <img src="/headimg/96/{{=it[i].supplier_id ? it[i].supplier_id : it[i].userid}}.jpg"  onerror="onerrorHeadimg()" class="supplierimg">
                <div class="supplierinfo_address">{{=it[i].province ? it[i].province : ''}}.{{=it[i].city ? it[i].city : ''}}</div>
                <div class="supplierinfo_name">{{=it[i].name  ? it[i].name : ''}}</div>
                <a href="tel:{{=it[i].phone}}" class="supplierinfo_phone">{{=it[i].phone ? it[i].phone : ''}}</a>   
                <div class="supplierinfo_hit">拉黑</div>
            </div>
        {{ } }}
    </script>
    <script id="dot_blacksupplierlist" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="blacksupplierinfo"  data-userid="{{=it[i].supplier_id ? it[i].supplier_id : it[i].userid}}">
                <img src="/headimg/96/{{=it[i].supplier_id ? it[i].supplier_id : it[i].userid}}.jpg"  onerror="onerrorHeadimg()" class="blacksupplierimg">
                <div class="blacksupplierinfo_address">{{=it[i].province ? it[i].province : ''}}.{{=it[i].city ? it[i].city : ''}}</div>
                <div class="blacksupplierinfo_name">{{=it[i].name ? it[i].name : ''}}</div>
                <a href="tel:{{=it[i].phone}}" class="blacksupplierinfo_phone">{{=it[i].phone ? it[i].phone : ''}}</a>  
                <div class="blacksupplierinfo_cancel">取消拉黑</div>
            </div>
        {{ } }}
    </script>
    <script id="dot_history_order_content" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="history_order_content" data-orderid="{{=it[i].id}}" data-address="{{=it[i].address}}">
                <div class="history_order_relcontent">
                    <div class="ordername">{{=it[i].ordername ? it[i].ordername : ''}}</div> 
                    <div class="ordertime">{{=makesimple(it[i].time)}}</div>
                </div>
                <div class="edit">
                    <button type="button" class="history_button history_order_copy">另存</button>
                    <button type="button" class="history_button history_order_delete">删除</button>
                </div>
            </div>
        {{ } }}
    </script>
    <script id="dot_bid_order" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="{{=checkclass(it[i].state)}}" data-userid="{{=it[i].userid}}" data-state="{{=it[i].state}}" data-orderid="{{=it[i].orderid}}" data-serial="{{=it[i].serial_number}}" data-id="{{=it[i].id}}">
                <div class="bid_content_row0 {{=(it[i].state < 3) ? 'hide' : ''}}">
                    <div class="bid_serial_number">编号：{{=it[i].serial_number}}</div>
                </div>  
                <div class="tenderuserinfo">
                    <div class="bid_content_row">
                        <div class="bid_content_name">{{=it[i].name}}</div>
                        <div class="bid_content_result" style="color:#888">{{=witchsate(it[i].state)}}</div>
                    </div>
                    <div class="bid_content_row1">
                        <div class="bid_content_price">单价:{{=(it[i].price/100)}}元</div>
                        <div class="bid_content_number">数量:{{=(it[i].number+it[i].unit)}}</div>
                    </div>
                    <div class="bid_content_row2">{{=attributes_show(it[i])}}</div>                    
                    <div class="bid_content_row2">{{= (it[i].order_switch_remark) ? '理由:'+it[i].order_switch_remark : ''}}</div>
                </div>
                <div class="orderinfos">
                </div>
                {{=(it[i].state < 3) ? '' : '<div class="bid_detail">查看详情</div>'}}
                {{=(it[i].is_evaluates) ? '' : '<div class="bid_content_evaluate">评论</div>'}}
                {{=(it[i].state == 4) ? '<div class="button_applydeposit">申请定金</div>' : ''}}
                {{=(it[i].state == 6) ? '<div class="agree">同意</div><div class="disagree">不同意</div>' : ''}}
                {{=(it[i].state == 10) ? '<div class="button_delivery">发货</div>' : ''}}
            </div>
        {{ } }}
    </script>
    <script id="dot_table_order" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div id="{{=it[i].id}}" class="order">
                <div class="ordertitle">
                    <div class="ordertitle_ordername">{{=it[i].ordername ? it[i].ordername : ''}}</div>
                    <div class="title_delete">删除</div>
                </div>
                <div class="ordercontent">
                    <div id="order_table{{=it[i].id}}"></div>
                    <div>
                        <div class="tree_order_address">用苗地：{{=it[i].address}}</div>
                        <div class="tree_order_lable">苗源地点：</div>
                        <div id="tree_origin_name{{=it[i].id}}" class="tree_origin_name"></div>
                    </div>
                    <div id="tree_arrive_address_city{{=it[i].id}}">
                    </div>
                    <div class="join_order">开始招标</div>
                </div>
            </div>
        {{ } }}
    </script>
    <script id="dot_historybidorder" type="text/x-dot-template">
        <div class="historybidorder">
            {{ for(var i in it) { }}
                <div class="historybidorder_one" userid="{{=it[i].userid}}">
                    <div class="historybidorder_one_name">{{=it[i].name}}</div>
                    <div class="historybidorder_one_price">{{=(it[i].price/100)}}元/{{=it[i].unit}}</div>
                    <a href="tel:{{=it[i].phone}}" class="historybidorder_one_phone">{{=it[i].phone ? it[i].phone : ''}}</a>
                    {{=it[i].is_evaluate ? '' : '<div class="historybidorder_one_evaluate">评价</div>'}}
                </div>
            {{ } }}
        </div>
    </script>
    <script id="dot_onedatabuy" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="buy_onedatainfo" treeuserid="{{=it[i].treeuserid}}" order_oneid="{{=it[i].id}}">
                <div>
                    <div class="info">
                        <div>订单编号：{{=it[i].serial_number}}</div>
                        <div><span>商品名称：</span><span class="treename">{{=it[i].name}}</span></div>
                        <div>规格：{{=one_attribute(it[i])}}</div>
                        <div class="{{=(it[i].address) ? '' : 'hide'}}">用苗地 ：{{=it[i].address}}</div>
                        <div class="{{=(it[i].mark) ? '' : 'hide'}}">备注 ：{{=it[i].mark}}</div>
                    </div>
                    <div>联系电话 ：<a href="tel:{{=it[i].userphone}}" class="info_phone">{{=it[i].userphone}}</a> </div>
                    <div class="{{=(it[i].order_switch_time) ? '' : 'hide'}}">退款理由 ：{{=(it[i].order_switch_remark) ? it[i].order_switch_remark : '无'}}</div>
                </div>
                <div>
                    <div class="button_detail">查看进程</div>                    
                    {{=(it[i].is_evaluate) ? '' : '<div class="button_evaluate">评价</div>'}}
                    {{=(it[i].state < 1) ? '<div class="button_paydown">付定金</div>' : ''}}
                    {{=((it[i].deposit_switch == 1) && (it[i].order_switch == 1)) ? '<div class="button_applyrefund">申请退定金</div>' : ''}}
                    {{=(it[i].order_switch == 3) ? '<div class="button_handing">等待卖家同意</div>' : ''}}
                    {{=(it[i].order_switch == 9) ? '<div class="button_handing">等待协商</div>' : ''}}
                    {{=((it[i].state < 2) || ((it[i].state == 2) && (it[i].deposit_switch == 2))) ? '<div class="button_payfull ">付全款</div>' : ''}}
                    {{=(it[i].order_switch == 5) ? '<div class="button_agreepay">同意</div>' : ''}}
                    {{=(it[i].order_switch == 5) ? '<div class="button_disagreepay">不同意</div>' : ''}}
                    {{=((it[i].state == 5) && (!it[i].delivery_time)) ? '<div class="button_delivery">等待卖家发货</div>' : ''}}

                    {{=((it[i].state == 8) && (it[i].order_switch == 1)) ? '<div class="button_receipt">确认收货</div>' : ''}}
                    {{=((it[i].state == 8) && (it[i].order_switch == 1)) ? '<div class="button_notreceipt">拒收货</div>' : ''}}
                    {{=(it[i].state == 10) ? '<div class="button_over">交易完成</div>' : ''}}
                </div>
            </div>
        {{ } }}
    </script>
    <script id="dot_onedatasell" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="sell_onedatainfo" userid="{{=it[i].userid}}" order_oneid="{{=it[i].id}}">
                <div>
                    <div class="info">
                        <div>订单编号：{{=it[i].serial_number}}</div>
                        <div><span>商品名称：</span><span class="treename">{{=it[i].name}}</span></div>
                        <div>规格：{{=one_attribute(it[i])}}</div>
                        <div class="{{=(it[i].address) ? '' : 'hide'}}">用苗地 ：{{=it[i].address}}</div>
                        <div class="{{=(it[i].mark) ? '' : 'hide'}}">备注 ：{{=it[i].mark}}</div>
                    </div>
                    <div>联系电话 ：<a href="tel:{{=it[i].phone}}" class="info_phone">{{=it[i].phone}}</a> </div>
                    <div class="{{=(it[i].order_switch_time) ? '' : 'hide'}}">退款理由 ：{{=(it[i].order_switch_remark) ? it[i].order_switch_remark : '无'}}</div>
                </div>
                <div>
                    <div class="button_detail">查看进程</div>
                    {{=(it[i].is_evaluates) ? '' : '<div class="button_evaluate">评价</div>'}}
                    {{=((it[i].deposit_switch == 1) && (it[i].order_switch == 1)) ? '<div class="button_applydeposit">申请定金</div>' : ''}}
                    {{=(it[i].order_switch == 3) ? '<div class="button_retreat">退定金</div><div class="button_notretreat">不退定金</div>' : ''}}
                    {{=(it[i].order_switch == 9) ? '<div class="button_handing">正在协商</div>' : ''}}
                    {{=((it[i].deposit_switch == 1) && (it[i].order_switch == 5)) ? '<div class="button_over">等待买家同意</div>' : ''}}
                    {{=((it[i].state == 2) && (it[i].deposit_switch == 2)) ? '<div class="button_over">等待买家付全款</div>' : ''}}
                    {{=((it[i].state == 5) && (!it[i].delivery_time)) ? '<div class="button_delivery">发货</div>' : ''}}


                    {{=((it[i].state == 8) && (it[i].order_switch == 1)) ? '<div class="button_over">运输中</div>' : ''}}
                    {{=(it[i].state == 10) ? '<div class="button_over">交易完成</div>' : ''}}
                </div>
            </div>
        {{ } }}
    </script>
    <script id="dot_moneyinfo" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="money_onedata">
                <div class="money_money">
                    <div class="money_row1">付款成功</div>
                    <div class="money_row2">{{=it[i].money/100}}元</div>
                </div>
                <div class="money_time">
                    <div class="money_row1">{{=it[i].time}}</div>
                    <div class="money_row3">{{=moneyway(it[i].way)}}</div>
                </div>
            </div>
        {{ } }}
    </script>
    <script src="./js/zepto.min.js"></script>
    <script type="text/javascript" src="./js/jweixin-1.0.0.js"></script>
    <script src="./js/example.js"></script>
    <script src="./js/doT.min.js"></script>
    <script type="text/javascript">
        var dot_table_order = doT.template($("#dot_table_order").text());
        var dot_bid_order = doT.template($("#dot_bid_order").text());
        var dot_supplierlist = doT.template($("#dot_supplierlist").text());
        var dot_blacksupplierlist = doT.template($("#dot_blacksupplierlist").text());
        var dot_history_order_content = doT.template($("#dot_history_order_content").text());
        var dot_historybidorder = doT.template($("#dot_historybidorder").text());
        var dot_screen_order = doT.template($("#dot_screen_order").text());
        var dot_show = doT.template($("#dot_show").text());
        var dot_bids = doT.template($("#dot_bids").text());
        var dot_onedatabuy = doT.template($("#dot_onedatabuy").text());
        var dot_onedatasell = doT.template($("#dot_onedatasell").text());
        var working = 0;
        var detailed_address;
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
        var cities;
        var finalkey=[];
        var finalprice = [];
        var fatherprivious = '';
        var button_ordernumber = 0;
        var dictionary;
        var dataid;
        var snake = -1;
        var mybidorder;
        var mysupplier = [];
        var mysupplierblack = [];
        var mycustomer = [];
        var mycustomerblack = [];
        var myhistory_order;
        var provinces_namehtml;
        var isLoadingsupplier = false;
        var isEndsupplier = false;
        var isLoadingblacksupplier = false;
        var isEndblacksupplier = false;
        var isEndcustomer = false;
        var isLoadingcustomer = false;
        var isEndblackcustomer = false;
        var isLoadingblackcustomer = false;
        var isLoadingbidhistory = false;
        var isEndbidhistory = false;
        var isLoadinghistory_order = false;
        var isEndhistory_order = false;
        var isLoadingfailurebidhistory = false;
        var isEndfailurebidhistory = false;
        var isEndundonebidhistory = false;
        var isLoadingundonebidhistory = false;
        var successbidinfo=[];
        var failurebidinfo=[];
        var undonebidinfo=[];
        var windowwidth = $(window).width();
        var windowheight = $(window).height();
        $('.evaluate_content').css('height',windowheight+'px');
        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        function getcookie(name){//获取指定名称的cookie的值
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }

        function shorttime(time){
            var time = time.split(" ");
            return time[0];
        }

        $('#homeindex').click(function(){
            $('#homeindex').hide();
            window.pageManager.go('home');
        })

        function moneyway(way){
            switch(way){
                case 1:
                    return '充值';
                    break;
                case 2:
                    return '付款';
                    break;
                case 3:
                    return '付款';
                    break;
                case 4:
                    return '取现';
                    break;
            }
        }

        function one_attribute(info){
            var attr = '';
            for( var key in info){
                if((key == 'age') && info[key]) attr += '苗龄 '+info[key] +'年';
                if((key == 'branch_bough_number') && info[key]) attr += '分枝数 '+info[key] +'个 ';
                if((key == 'substrate') && info[key]) info[key] += '基质 '+info[key];
                if(key == 'dbh'){
                    if(info['dbh_type'] == '5') attr += '胸径 '+parseInt(10*info[key])/10 +'公分 ';
                    if(info['dbh_type'] == '6') attr += '地径 '+parseInt(10*info[key])/10 +'公分 ';
                    if(info['dbh_type'] == '7') attr += '盆径 '+parseInt(10*info[key])/10 +'公分 ';
                }
                if(key == 'height'){
                    if(info['height_type'] == '10') attr += '株高 '+parseInt(10*info[key])/10 +'米 ';
                    if(info['height_type'] == '11') attr += '条长 '+parseInt(10*info[key])/10 +'米 ';
                    if(info['height_type'] == '12') attr += '主枝长 '+parseInt(10*info[key])/10 +'米 ';
                }
                if((key == 'branch_point_height') && info[key]){
                   attr += '分枝点高 '+parseInt(10*info[key])/10 +'米 '; 
                } 
                if((key == 'crownwidth') && info[key]){
                    attr += '冠幅 '+parseInt(10*info[key])/10 +'米 ';
                }
            }
            return attr;
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
            if(data_attribute.mark){
                var at = data_attribute.mark;
                attr += '备注:'+at;
            }
            
            return attr;
        }

        function onerrorHeadimg() {
            var event = window.event || arguments.callee.caller.arguments[0]; // 获取event对象
            var img = event.currentTarget || event.srcElement || event.target; // 获取触发事件的源对象
            img.src = 'http://cnzhaoshu.com/headimg/96/1.jpg';
        }

        function witchsate(staten){
            if(staten == -1){
                return '未通过';
            }else if(staten == 1){
                return '正被选标';
            }else if(staten == 2){
                return '等待买家付定金';
            }else if(staten == 4){
                return '买家已付定金';
            }else if(staten == 6){
                return '买申请退定金';
            }else if(staten == 8){
                return '申请定金';
            }else if(staten == 9){
                return '收到定金';
            }else if(staten == 10){
                return '买家已付全款';
            }else if(staten == 12){
                return '已发货';
            }else if(staten == 14){
                return '买家已收货';
            }else if(staten == 16){
                return '平台正在协商';
            }else if(staten == 18){
                return '交易完成';
            }
        }
        // 加载字典
        function loaddictionary(){
            $.getJSON('/com/dictionary_attribute_search.php',function(json){
                if (json) {
                    dictionary = json;
                }
            });
        }
    </script>
    <script type="text/html" id="tpl_home">
        <div class="page">
            <div class="page__hd"> 
                <h2>我的交易</h2>
            </div>
            <div class="page__bd page__bd_spacing">
                <ul>
                    <li>
                        <a class="weui-cell_access js_item" data-id="current_order" href="javascript:;">
                            <p class="weui-flex__item" style="width: 100%;padding: 20px;">制作我的招标二维码</p>
                        </a>
                    </li>
                    <li>
                        <div class="weui-flex js_category" style="position: relative">
                            <p class="weui-flex__item">我的招标</p>
                            <div class="marking" style="position: absolute;left: 90px;" id="mytendermark"></div>
                            <img src="./images/icon_nav_nav.png" alt="">
                        </div>
                        <div class="page__category js_categoryInner">
                            <div class="weui-cells page__category-content">
                                <a class="weui-cell weui-cell_access js_item" data-id="tender" href="javascript:;"  style="position: relative">
                                    <div class="weui-cell__bd">
                                        <p>正在进行的招标</p>
                                        <div class="marking" style="position: absolute;left: 145px;top:14px;" id="mytendermarking"></div>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                                <a class="weui-cell weui-cell_access js_item" data-id="supplier" href="javascript:;">
                                    <div class="weui-cell__bd">
                                        <p>供货商</p>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                                <a class="weui-cell weui-cell_access js_item" data-id="tenderhistory" href="javascript:;">
                                    <div class="weui-cell__bd">
                                        <p>历史信息</p>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="weui-flex js_category" style="position: relative">
                            <p class="weui-flex__item">我的投标</p>
                            <div class="marking" style="position: absolute;left: 90px" id="mybidmark"></div>
                            <img src="./images/icon_nav_nav.png" alt="">
                        </div>
                        <div class="page__category js_categoryInner">
                            <div class="weui-cells page__category-content">
                                <a class="weui-cell weui-cell_access js_item" data-id="bidhistory" href="javascript:;"  style="position: relative">
                                    <div class="weui-cell__bd">
                                        <p>投标信息</p>
                                        <div class="marking" style="position: absolute;left: 92px;top:14px" id="mybidmarking"></div>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                                <a class="weui-cell weui-cell_access js_item" data-id="customer" href="javascript:;">
                                    <div class="weui-cell__bd">
                                        <p>我的客户</p>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="weui-flex js_category">
                            <p class="weui-flex__item">找树宝</p>
                            <img src="./images/icon_nav_nav.png" alt="">
                        </div>
                        <div class="page__category js_categoryInner">
                            <div class="weui-cells page__category-content">
                                <a class="weui-cell weui-cell_access js_item" data-id="managerbuy" href="javascript:;">
                                    <div class="weui-cell__bd">
                                        <p>我是买方</p>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                                <a class="weui-cell weui-cell_access js_item" data-id="managersell" href="javascript:;">
                                    <div class="weui-cell__bd">
                                        <p>我是卖方</p>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="weui-cell_access js_item" data-id="mywallet" href="javascript:;">
                            <p class="weui-flex__item" style="width: 100%;padding: 20px;">我的钱包</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            $(function(){
                var winH = $(window).height();
                var categorySpace = 10;
                $('#homeindex').hide();
                $('.js_item').on('click', function(){
                    var id = $(this).data('id');
                    window.pageManager.go(id);
                    $('#homeindex').show();
                });
                $('.js_category').on('click', function(){
                    var $this = $(this),
                        $inner = $this.next('.js_categoryInner'),
                        $page = $this.parents('.page'),
                        $parent = $(this).parent('li');
                    var innerH = $inner.data('height');
                    bear = $page;

                    if(!innerH){
                        $inner.css('height', 'auto');
                        innerH = $inner.height();
                        $inner.removeAttr('style');
                        $inner.data('height', innerH);
                    }

                    if($parent.hasClass('js_show')){
                        $parent.removeClass('js_show');
                    }else{
                        $parent.siblings().removeClass('js_show');

                        $parent.addClass('js_show');
                        if(this.offsetTop + this.offsetHeight + innerH > $page.scrollTop() + winH){
                            var scrollTop = this.offsetTop + this.offsetHeight + innerH - winH + categorySpace;

                            if(scrollTop > this.offsetTop){
                                scrollTop = this.offsetTop - categorySpace;
                            }

                            $page.scrollTop(scrollTop);
                        }
                    }
                });
            });

            $.getJSON('/com/search_number.php',{userid:user.userid},function(result){
                if(result.tendernumber){
                    $('#mytendermark').html(result.tendernumber);
                    $('#mytendermarking').html(result.tendernumber);
                }else{
                    $('#mytendermark').hide();
                    $('#mytendermarking').hide();
                }
                if(result.bidnumber){
                    $('#mybidmark').html(result.bidnumber);
                    $('#mybidmarking').html(result.bidnumber);
                }else{
                    $('#mybidmark').hide();
                    $('#mybidmarking').hide();
                }

            })
        </script>
    </script>
    <script type="text/html" id="tpl_tender">
        <div class="page">
            <div class="page__hd">
                <h1 class="page__title">招标</h1>
            </div>
            <div class="page__bd page__bd_spacing">
                <div id="screenlist">                    
                </div>                
                <div id="tenderfoot">
                    <div class="getexcel">导出清单</div>
                    <div class="getphoto">获取图片</div>
                    <div class="changetime">截止日期</div>
                    <div class="sendmessage">群发比对</div>
                </div>
                <div id="alerttime">
                    <div id="alertinfo">
                        <div style="text-align:center;margin:6% 0px;"><h3>输入订单截止日期</h3></div>
                        <input type="date" id="order_time" class="form_control_alert">
                        <a class="weui-btn weui-btn_mini weui-btn_primary order_time_button_reset">取消</a>
                        <a class="weui-btn weui-btn_mini weui-btn_primary" id="order_time_button">提交</a>
                    </div>
                </div> 
                <div class="bigimages"><div id="bigimages"></div></div>
            </div>
            
        </div>
        <script type="text/javascript">
            var refund;
            var notreceipt;
            $('.bigimages').css('width',windowwidth+'px');                    
            $('.bigimages').css('height',windowheight+'px'); 
            var timenow;                   
            loadscreenlist();

            function findorders(orderid,that){
                $.getJSON('/com/search_mytreeorders.php',{orderid:orderid,userid:user.userid},function(json){
                    if(json){
                        $('.check .allorder').html(dot_show(json));
                        that.parents('.order').find('.allorder').css('height','auto');
                    }
                })
            }

            function loadscreenlist(){
                $.getJSON('/com/search_tendering.php',{userid:user.userid},function(json){
                    $('#screenlist').append(dot_screen_order(json));
                })
            }

            $('.sendmessage').click(function(){
                if($('.sendmessage').attr('orderid')){
                    var orderid = $('.sendmessage').attr('orderid');
                    window.location = '/tenders.php?orderid='+orderid;
                }else{
                    alert('每个订单只能发送一次消息');
                }  
            })

            $('.changetime').click(function(){
                if($('.changetime').attr('orderid')){
                    $('#alerttime').show();
                    var orderid = $('.sendmessage').attr('orderid');
                    $('#order_time_button').attr('data-orderid',orderid);
                }
            })

            $('#order_time_button').click(function(){
                var time = $('#order_time').val();
                var orderid = $(this).data('orderid');
                if(time){
                    $.getJSON('/com/deal_changeordertime.php',{orderid:orderid,time:time},function(result){
                        $('#alerttime').hide();
                        if(result){
                            $('#bigimages').html('');
                            timenow = new Date().getTime();
                            $('<img>').addClass('bigimage').attr('src','./tenderimage/'+result+'.jpg?t='+ timenow).appendTo('#bigimages');
                            $('.bigimages').show();
                        }
                    })
                }else{
                    alert('时间不能为空！');
                }
            })

            $('.order_time_button_reset').click(function(){
                $('#order_time_button').attr('data-orderid','');
                $('#order_time').val('');
                $('#alerttime').hide();
            })

            $('.getphoto').click(function(){
                var qrcode = $('.getphoto').attr('qrcode');
                $('#bigimages').html('');
                $('<img>').addClass('bigimage').attr('src','./tenderimage/'+qrcode+'.jpg?t='+timenow).appendTo('#bigimages');
                $('.bigimages').show();
            })
            
            $('.getexcel').click(function(){
                var orderid = $(this).attr('orderid');
                window.location = '/com/getbidexcel.php?userid='+user.userid+'&orderid='+orderid;
            })

            
            function addone(one){
                var a = 1+parseInt(one);
                return a+'.';
            }

            function tendertitlebuttonstate(review_state,tendering){
                if(review_state == 0){
                    return 1;
                }else if(tendering == 1){
                    return 3;
                }
            }

            function tendertitlebutton(review_state,tendering){
                if(review_state == 0){
                    return '待审核';
                }else if(tendering == 1){
                    return '正在招标';
                }
            }
            
            function opentendertitlebutton(name,thisbuttonstate){
                if(name == '待审核'){
                    thisbuttonstate.parent().find('.order_state').attr('class','order_state0');
                    return '待审核';
                }else if(name == '正在招标'){
                    thisbuttonstate.parent().find('.order_state').attr('state','6');
                    return '停止招标';
                }else if(name == '停止招标'){
                    thisbuttonstate.parent().find('.order_state').attr('state','3');
                    return '正在招标';
                }
            }


            $('#screenlist').on('click','.order_ordername',function(){
                var that = $(this);
                var send_msg = that.parents('.order').attr('send_msg');

                if(that.parents('.order').hasClass('check')){
                    var name = opentendertitlebutton(that.parents('.order').find('.order_state').html(),that);
                    that.parents('.order').find('.order_state').html(name);
                    that.parents('.order').removeClass('check');
                    $('#screenlist .allorder').css('height','0px');
                    $('#screenlist .allorder').hide();
                    $('#tenderfoot').hide();
                    $('.sendmessage').attr('orderid',null);
                    $('.getphoto').attr('qrcode',null);
                    $('.getexcel').attr('orderid',null);
                    $('.changetime').attr('orderid',null);
                    $('#order_time').val('');
                }else{
                    $('#tenderfoot').show();
                    var orderid = that.parents('.order').attr('id');
                    var qrcode = that.parents('.order').attr('qrcode');
                    var expiration_date = that.parents('.order').attr('expiration_date');
                    if(send_msg == 1){
                        $('.sendmessage').attr('orderid',null);
                    }else{
                        $('.sendmessage').attr('orderid',orderid);
                    }
                    $('.getphoto').attr('qrcode',qrcode);
                    $('.getexcel').attr('orderid',orderid);
                    $('.changetime').attr('orderid',orderid);
                    $('#order_time').val(expiration_date);
                    var name = opentendertitlebutton(that.parents('#screenlist').find('.check .order_state').html(),that);
                    that.parents('#screenlist').find('.check .order_state').html(name);
                    var name = opentendertitlebutton(that.parents('.order').find('.order_state').html(),that);
                    that.parents('.order').find('.order_state').html(name);
                    $('#screenlist .order').removeClass('check');
                    that.parents('.order').addClass('check');
                    that.parents('.order').siblings().find('.allorder').css('height','0px');
                    that.parents('.order').siblings().find('.allorder').hide();
                    that.parents('.order').find('.allorder').show();
                    var lengthss = that.parents('.order').find('.showone').length;
                    if(lengthss){
                        that.parents('.order').find('.allorder').css('height','auto');
                    }else{
                        findorders(orderid,that);
                    }
                }
            })

            $('#screenlist').on('click','.check .order_state',function(){
                var statethis = $(this);
                var orderid = statethis.parents('.order').attr('id');
                var state = statethis.attr('state');
                if(state == 6){
                    var tendering = 2;
                    $.getJSON('/com/deal_tenderingorder.php',{orderid:orderid,tendering:tendering},function(result){
                        statethis.parents('.order').remove();
                        var num = $('#mytendermark').html() - 1;
                        if(num>0){
                            $('#mytendermark').html(num);
                            $('#mytendermarking').html(num);
                        }else{
                            $('#mytendermark').hide();
                            $('#mytendermarking').hide();
                        }   
                    })
                }
            })

            $('#screenlist').on('click','.allorder',function(){
                var qrcode = $(this).parents('.order').attr('qrcode');
                window.location = './qrcodeorder.php?id='+qrcode;
            })

        </script>
    </script>
    <script type="text/html" id="tpl_supplier">
        <div class="page">
            <div class="page__bd" style="height: 100%;">
                <div class="weui-tab">
                    <div class="headtitle1">
                        <div class="topbutton checked supplierlist">
                            供应商
                        </div>
                        <div class="topbutton blacktitle">
                            黑名单
                        </div>
                    </div>
                    <div class="weui-tab__panel" id="supplierlist">

                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">          
            function loadsupplier(){
                if (isLoadingsupplier) return;
                isLoadingsupplier = true;
                var limit = $('#supplierlist .supplierinfo').length + ',' + 10;
                $.getJSON('/com/search_mysupplier.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            var mark =true;
                            for (var j = 0; j < mysupplier.length; j++) {
                                if(mysupplier[j].supplier_id == json[i].supplier_id) mark = false;
                            }
                            if(mark){
                                mysupplier[mysupplier.length] = json[i];
                                var news = [];
                                news[0] = json[i];
                                $('#supplierlist').append(dot_supplierlist(news));
                            } 
                        }
                        if(json.length < 10) isEndsupplier = true;
                    }else{
                        isEndsupplier = true;
                    }
                    isLoadingsupplier = false;
                })
            }
            function loadblacksupplier(){
                if (isLoadingblacksupplier) return;
                isLoadingblacksupplier = true;
                var limit = $('#supplierlist .blacksupplierinfo').length + ',' + 10;
                $.getJSON('/com/search_mysupplierblack.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            var mark =true;
                            for (var j = 0; j < mysupplierblack.length; j++) {
                                if(mysupplierblack[j].supplier_id == json[i].supplier_id) mark = false;
                            }
                            if(mark){
                                mysupplierblack[mysupplierblack.length] = json[i];
                                var news = [];
                                news[0] = json[i];
                                $('#supplierlist').append(dot_blacksupplierlist(news));
                            } 
                        }
                        if(json.length < 10) isEndblacksupplier = true;
                    }else{
                        isEndblacksupplier = true;
                    }
                    isLoadingblacksupplier = false;
                })
            }
            function changesupplierstate(supplierid,state,that){
                $.getJSON('/com/update_editesupplier.php',{userid:user.userid,supplierid:supplierid,state:state},function(result){
                    if(result){
                        if(state == 1){
                            var b = [];
                            for (var i = 0; i < mysupplierblack.length; i++) {
                                if(mysupplierblack[i].supplier_id != supplierid){
                                    b[b.length] = mysupplierblack[i];
                                }else{
                                    mysupplier[mysupplier.length] = mysupplierblack[i];
                                }
                            }
                            that.remove();
                            mysupplierblack = b;
                            var number = $('#supplierlist .blacksupplierinfo').length;
                            if((number < 10) && (!isEndblacksupplier)) loadblacksupplier();
                        } 
                        if(state == 2){
                            var b = [];
                            for (var i = 0; i < mysupplier.length; i++) {
                                if(mysupplier[i].supplier_id != supplierid){
                                    b[b.length] = mysupplier[i];
                                }else{
                                    mysupplierblack[mysupplierblack.length] = mysupplier[i];
                                }
                            }
                            mysupplier = b;
                            that.remove();
                            var number = $('#supplierlist .supplierinfo').length;
                            if((number < 10) && (!isEndsupplier)) loadsupplier();
                        } 
                    }
                })
            }

            $('.supplierlist').click(function(){
                $(this).addClass('checked').siblings('.checked').removeClass('checked');
                $('#supplierlist').html('');
                if(mysupplier.length){
                    $('#supplierlist').append(dot_supplierlist(mysupplier));
                }else{
                    loadsupplier();
                }
            })

            $('.blacktitle').click(function(){
                $(this).addClass('checked').siblings('.checked').removeClass('checked');
                $('#supplierlist').html('');
                if(mysupplierblack.length){
                    $('#supplierlist').append(dot_blacksupplierlist(mysupplierblack));
                }else{
                    loadblacksupplier();
                }
            })

            $('#supplierlist').scroll(function() {
                var isblacksupplierinfo = $('#supplierlist .blacksupplierinfo').length;
                var issupplierinfo = $('#supplierlist .supplierinfo').length
                if(issupplierinfo){
                    if (isEndsupplier || isLoadingsupplier) return;
                    var scrollHeight = $(this)[0].scrollHeight;
                    var scrollTop = $(this)[0].scrollTop;
                    var elementHight = $(this).height();
                    if(scrollTop + elementHight >= scrollHeight-100) {
                        loadsupplier();
                    } 
                }else{
                    if (isLoadingblacksupplier || isEndblacksupplier) return;
                    var scrollHeight = $(this)[0].scrollHeight;
                    var scrollTop = $(this)[0].scrollTop;
                    var elementHight = $(this).height();
                    if(scrollTop + elementHight >= scrollHeight-100) {
                        loadblacksupplier();
                    }
                }   
            })

            $('#supplierlist').on('click','.supplierinfo_hit',function(){
                var that = $(this).parent();
                var userid = $(this).parent().data('userid');
                changesupplierstate(userid,2,that);
            })

            $('#supplierlist').on('click','.blacksupplierinfo_cancel',function(){
                var that = $(this).parent();
                var userid = $(this).parent().data('userid');
                changesupplierstate(userid,1,that);
            })

            loadsupplier();
        </script>
    </script>
    <script type="text/html" id="tpl_tenderhistory">
        <div class="page">
            <div class="page__hd" style="height:32px;">
                <div class="hd_title">历史清单</div>
                <div class="clean">清空</div>
            </div>
            <div class="page__bd" id="history_orders">
                <div class="weui-cells weui-cells_form" style="float: left;width: 96%;margin: 0 2%;">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">名称</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" id="key_name" placeholder="输入搜索的清单名称"/>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">地址</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" id="key_area" placeholder="输入搜索的地址"/>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">日期</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="date" id="key_time1" placeholder="最早日期">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label for="" class="weui-label">日期</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="date" id="key_time2" placeholder="最晚日期">
                        </div>
                    </div>
                </div>
                <div class="history_title">
                    <div class="title_ordername">订单名称</div>
                    <div class="title_ordertime">订单日期</div>
                    <div class="title_edit">操作</div>
                </div>
                <div id="history_order_contents">
                </div>
                <div class="history_order_content_orderdetail">
                    <div id="history_order_content_orders">
                        <div id="history_ordername_title"></div>
                        <div id="history_order_content_order">
                        </div>
                        <div class="arriveaddressdiv">
                            <div class="arriveaddresstitle">用苗地：</div>
                            <div id="arriveaddress"></div>
                        </div>
                    </div>
                    <div id="hideshow"></div>
                </div>
                <div id="alertordername">
                    <div id="alertinfo">
                        <div style="text-align:center;margin:6% 0px;"><h3>输入新订单名称及用苗地点</h3></div>
                        <input type="text" id="order_name" class="form_control_alert" placeholder="订单名称">
                        <input type="text" id="tree_arrive_address" class="form_control_alert" placeholder="用苗地点">
                        <a class="weui-btn weui-btn_mini weui-btn_primary order_name_button_reset">取消</a>
                        <a class="weui-btn weui-btn_mini weui-btn_primary" id="order_name_button">提交</a>
                    </div>
                </div>
                
            </div>
        </div>
        <script type="text/javascript">
            $('#history_order_contents').css('height',(windowheight-280)+'px');
            $('.history_order_content_orderdetail').css('height',windowheight+'px');
            $('#history_order_content_orders').css('height',windowheight+'px');
            var starnumber;
            var evaluatebutton;
            loadHistoryOrder();
            function loadHistoryOrder(){
                if (isLoadinghistory_order) return;
                isLoadinghistory_order = true;
                var key_name = $.trim($('#key_name').val());
                var key_area = $.trim($('#key_area').val());
                var key_time1 = $.trim($('#key_time1').val());
                var key_time2 = $.trim($('#key_time2').val());
                if(key_name || key_area || key_time1 || key_time2){
                    var searchingmark = true;
                }else{
                    var limit = $('#history_order_contents .history_order_content').length + ',' + 15;
                }
                $.getJSON('/com/orders_index_search.php',{area:key_area,name:key_name,time1:key_time1,time2:key_time2,userid:user.userid,limit:limit},function(json){
                    if(searchingmark){
                        if(json){
                            $('#history_order_contents').html(dot_history_order_content(json));
                        }else{
                            $('#history_order_contents').html('');
                        }
                        isEndhistory_order = true;
                        isLoadinghistory_order = false;
                    }else{
                        if(json){
                            $('#history_order_contents').append(dot_history_order_content(json));
                            if(json.length < 15) isEndhistory_order = true;
                        }else{
                            isEndhistory_order = true;
                        }
                        isLoadinghistory_order = false;
                    }

                });
            }
            function makesimple(time){
                return time.split(' ')[0];
            }
            function showhistoryorder(json){
                $('#history_order_content_order').html();
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
                    order_content += '<div class="table" data-orderid="'+json[i].orderid+'" data-id="'+json[i].id+'">';
                    order_content += '<div class="table_order">'+(1+i)+'.</div>';
                    order_content += '<div class="table_content">';
                    order_content += '<div class="table_row1_clos1">';
                    order_content += '<div class="tree_name">'+json[i].name+'</div>';
                    order_content += '<div class="tree_number">'+json[i].count+'('+json[i].unit+')'+'</div>';
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
                $('#history_order_content_order').html(order_content);
            }

            $('#key_name').change(function(){
                isEndhistory_order = false;
                $('#history_order_contents').html('');
                loadHistoryOrder();
            });
            $('#key_area').change(function(){
                isEndhistory_order = false;
                $('#history_order_contents').html('');
                loadHistoryOrder();
            });
            $('#key_time1').change(function(){
                var key_time1 = $('#key_time1').val();
                var key_time2 = $('#key_time2').val();
                if(key_time1 && key_time2){
                    isEndhistory_order = false;
                    loadHistoryOrder();
                }
            });
            $('#key_time2').change(function(){
                var key_time1 = $('#key_time1').val();
                var key_time2 = $('#key_time2').val();
                if(key_time1 && key_time2){
                    isEndhistory_order = false;
                    loadHistoryOrder();
                }
            });
            $('.clean').click(function(){
                $('#key_time1').val('');
                $('#key_time2').val('');
                $('#key_name').val('');
                $('#key_area').val('');
                $('#history_order_contents').html('');
                loadHistoryOrder();
            })

            $('#history_order_contents').on('click','.history_order_relcontent',function(){

                $('.history_order_content_orderdetail').show();
                $('#homeindex').hide();
                var orderid = $(this).parents('.history_order_content').data('orderid');
                var ordername = $(this).parents('.history_order_content').find('.ordername').html();

                $('#history_ordername_title').html(ordername);
                var horderaddress = $(this).parents('.history_order_content').data('address');

                if(horderaddress){
                    $('#arriveaddress').html(horderaddress);
                }else{
                    $('#arriveaddress').html('未设置用苗地');
                }
                $.getJSON('/com/order_search.php',{orderid:orderid},function(json){
                    showhistoryorder(json);
                });
            });

            $('#hideshow').click(function(){
                $('.history_order_content_orderdetail').hide();
                $('#homeindex').show();
            });

            $('#history_order_contents').on("click",'.history_order_delete',function(){
                var hidden = $(this);
                var orderid = hidden.parents('.history_order_content').data('orderid');
                var edit = confirm('你确定要删除吗?');
                if(edit == true){
                    $.get('/com/order_delete.php',{orderid:orderid},function(json){
                        if(json){
                            hidden.parents('.history_order_content').remove();
                        }
                    });
                }
            });
            $('#history_order_contents').on("click",'.history_order_copy',function(){
                var orderid = $(this).parents('.history_order_content').data('orderid');
                $('#alertordername').show();
                $('#order_name_button').attr('data-orderid',orderid);
                $('#order_name').focus();
            })
            $('#order_name_button').click(function(){
                var ordername = $('#order_name').val();
                var detailed_address = $('#tree_arrive_address').val();                    
                if(ordername && (detailed_address.length > 1)){
                    var orderid = $('#order_name_button').data('orderid');
                    if(orderid){
                        $.post('/com/copy_neworder.php',{orderid:orderid,userid:user.userid,ordername:ordername,address:detailed_address},function(data){
                            if(data){
                                $('#alertordername').hide();
                                $('#tree_arrive_address').val('');
                                $('#order_name').val('');
                                window.pageManager.go('current_order');
                            }
                        })
                    }
                }else{
                    alert('请完善信息！');
                }
            })

            $('#history_order_contents').scroll(function () {
                if (isLoadinghistory_order || isEndhistory_order) return;
                var scrollHeight = $(this)[0].scrollHeight;
                var scrollTop = $(this)[0].scrollTop;
                var elementHight = $(this).height();
                if(scrollTop + elementHight >= scrollHeight-50) {
                    loadHistoryOrder();
                } 
            });

            $('.order_name_button_reset').click(function(){
                $('#alertordername').hide();
                $('#order_name_button').removeAttr('data-orderid');
                $('#order_name').val('');
            })

            $('#history_order_content_orders').on('click','.table_content',function(){
                var that = $(this);
                if(that.hasClass('check')){
                    that.removeClass('check');
                    that.parent().css('background','#fff');
                    that.parent().find('.historybidorder').hide();
                }else{
                    that.addClass('check');
                    that.parent().css('background','#eee');
                    if(that.hasClass('loaded')){
                        that.parent().find('.historybidorder').show();
                    }else{
                        var orderid = that.parent().data('orderid');
                        var id = that.parent().data('id');
                        $.getJSON('/com/search_successbidinfo.php',{orderid:orderid,id:id,userid:user.userid},function(json){
                            if(json){
                                that.parent().append(dot_historybidorder(json));
                                that.addClass('loaded');
                            }
                        })                    
                    }            
                }
            })

            $('#history_order_content_orders').on('click','.historybidorder_one_evaluate',function(){
                evaluatebutton = $(this);
                $('.evaluate_content').show();
            })

            $('.showstar').click(function(){
                var starsn = $(this).attr('state');
                $('.starover').removeClass('starover');
                starsn = parseInt(starsn);
                starnumber = 0;
                for (var i = 0; i < starsn; i++) {
                    starnumber = 1+i;
                    $('.star'+starnumber).addClass('starover');
                }
            })

            $('#evaluate_upload').click(function(){
                if(starnumber > 0){
                    var evaluate_text = $('#evaluate_text').val();
                    var userid = evaluatebutton.parent().attr('userid');
                    var id = evaluatebutton.parents('.table').attr('data-id');
                    $.getJSON('/com/shop_evaluate.php',{evaluate:evaluate_text,treeuserid:userid,userid:user.userid,starnumber:starnumber,id:id},function(result){
                        if(result){
                            $('#evaluate_text').val('');
                            starnumber = 0;
                            $('.evaluate_content').hide();
                            $('.starover').removeClass('starover');
                            evaluatebutton.remove();
                            alert('评价成功！');
                        }else{
                            alert('评价失败！');
                        }
                    })
                }else{
                    alert('请选择您的满意度！');
                }
            })

            $('#evaluate_reset').click(function(){
                $('#evaluate_text').val('');
                starnumber = 0;
                $('.evaluate_content').hide();
                $('.starover').removeClass('starover');
            })
        </script>
    </script>
    <script type="text/html" id="tpl_customer">
        <div class="page">
            <div class="page__bd" style="height: 100%;">
                <div class="weui-tab">
                    <div class="headtitle1">
                        <div class="topbutton checked customerlist">
                            我的客户
                        </div>
                        <div class="topbutton blackcustomerlist">
                            黑名单
                        </div>
                    </div>
                    <div class="weui-tab__panel" id="customerlist">
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            loadcustomer();
            function loadcustomer(){
                if(isLoadingcustomer) return false;
                isLoadingcustomer = true;
                var limit = $('#customerlist .supplierinfo').length + ',' + 10;
                $.getJSON('/com/search_mycustomer.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            var mark = true;
                            for (var j = 0; j < mycustomer.length; j++) {
                                if(mycustomer[j].userid == json[i].userid) mark = false;
                            }
                            if(mark){
                                mycustomer[mycustomer.length] = json[i];
                                var news = [];
                                news[0] = json[i];
                                $('#customerlist').append(dot_supplierlist(news));
                            } 
                        }
                        if(json.length < 10) isEndcustomer = true;
                    }else{
                        isEndcustomer = true;
                    }
                    isLoadingcustomer = false;
                })
            }
            function loadblackcustomer(){
                if (isLoadingblackcustomer) return;
                isLoadingblackcustomer = true;
                var limit = $('#customerlist .blacksupplierinfo').length + ',' + 10;
                $.getJSON('/com/search_mycustomerblack.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            var mark =true;
                            for (var j = 0; j < mycustomerblack.length; j++) {
                                if(mycustomerblack[j].userid == json[i].userid) mark = false;
                            }
                            if(mark){
                                mycustomerblack[mycustomerblack.length] = json[i];
                                var news = [];
                                news[0] = json[i];
                                $('#customerlist').append(dot_blacksupplierlist(news));
                            } 
                        }
                        if(json.length < 10) isEndblackcustomer = true;
                    }else{
                        isEndblackcustomer = true;
                    }
                    isLoadingblackcustomer = false;
                })
            }
            function changecustomerstate(customerid,state,that){
                $.getJSON('/com/update_editecustomer.php',{userid:customerid,supplierid:user.userid,state:state},function(result){
                    if(result){
                        if(state == 1){
                            var b = [];
                            for (var i = 0; i < mycustomerblack.length; i++) {
                                if(mycustomerblack[i].userid != customerid){
                                    b[b.length] = mycustomerblack[i];
                                }else{
                                    mycustomer[mycustomer.length] = mycustomerblack[i];
                                }
                            }
                            that.remove();
                            mycustomerblack = b;
                            var number = $('#customerlist .blacksupplierinfo').length;
                            if((number < 10) && (!isEndblackcustomer)) loadblackcustomer();
                        } 
                        if(state == 2){
                            var b = [];
                            for (var i = 0; i < mycustomer.length; i++) {
                                if(mycustomer[i].userid != customerid){
                                    b[b.length] = mycustomer[i];
                                }else{
                                    mycustomerblack[mycustomerblack.length] = mycustomer[i];
                                }
                            }
                            mycustomer = b;
                            that.remove();
                            var number = $('#customerlist .supplierinfo').length;
                            if((number < 10) && (!isEndcustomer)) loadcustomer();
                        } 
                    }
                })
            }

            $('.customerlist').click(function(){
                $(this).addClass('checked').siblings('.checked').removeClass('checked');
                $('#customerlist').html('');
                if(mycustomer.length){
                    $('#customerlist').append(dot_supplierlist(mycustomer));
                }else{
                    loadcustomer();
                }
            })

            $('.blackcustomerlist').click(function(){
                $(this).addClass('checked').siblings('.checked').removeClass('checked');
                $('#customerlist').html('');
                if(mycustomerblack.length){
                    $('#customerlist').append(dot_blacksupplierlist(mycustomerblack));
                }else{
                    loadblackcustomer();
                }
            })

            $('#customerlist').scroll(function () {             
                var isblackcustomerlist = $('#customerlist .blacksupplierinfo').length;
                var iscustomerlist = $('#customerlist .supplierinfo').length
                if(iscustomerlist){
                    if(isLoadingcustomer || isEndcustomer) return;
                    var scrollHeight = $(this)[0].scrollHeight;
                    var scrollTop = $(this)[0].scrollTop;
                    var elementHight = $(this).height();
                    if(scrollTop + elementHight >= scrollHeight-100) {
                        loadcustomer();
                    } 
                }else{
                    if (isLoadingblackcustomer || isEndblackcustomer) return;
                    var scrollHeight = $(this)[0].scrollHeight;
                    var scrollTop = $(this)[0].scrollTop;
                    var elementHight = $(this).height();
                    if(scrollTop + elementHight >= scrollHeight-100) {
                        loadblackcustomer();
                    }
                }  
            })

            $('#customerlist').on('click','.supplierinfo_hit',function(){
                var that = $(this).parent();
                var userid = $(this).parent().data('userid');
                changecustomerstate(userid,2,that);
            })

            $('#customerlist').on('click','.blacksupplierinfo_cancel',function(){
                var that = $(this).parent();
                var userid = $(this).parent().data('userid');
                changecustomerstate(userid,1,that);
            })
        </script>
    </script>
    <script type="text/html" id="tpl_bidhistory">
        <div class="page">
            <div class="page__bd" style="height: 100%;">
                <div class="weui-tab">
                    <div class="headtitle1">
                        <div class="topbutton undone">
                            待选标
                        </div>
                        <div class="topbutton successbid checked">
                            交易中
                        </div>
                        <div class="topbutton overbid">
                            已完成
                        </div>
                        <div class="topbutton failurebid">
                            未中标
                        </div>
                    </div>
                    <div class="weui-tab__panel" id="bidhistory_info">
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">            
            var timearray = ['orderstart_time','deposit_time','deposit_refund_time','fullamount_time','delivery_time','receipt_time','payment_time','refund_time','order_switch_time'];
            var timeimpact = { 
                deposit_time: "deposit", 
                deposit_refund_time: "deposit", 
                fullamount_time: "fullamount", 
                payment_time: "payment_mount", 
                refund_time: "refund_mount"
            };
            
            var timename = {
                orderstart_time: "买家下订单",
                deposit_time: "买家已付定金",
                deposit_refund_time: "收到定金",
                fullamount_time: "买家已付全款",
                delivery_time: "发货",
                receipt_time: "买家确认收货",
                payment_time: "完成交易收到资金",
                refund_time: "退还资金",
                order_switch_time: "申请退资金"
            }
            loadsuccessbidorder();
            var overbidinfo = [];
            var isEndoverbidhistory = false;
            var isLoadingoverbidhistory = false;
            $('.evaluate_content').css('height',windowheight+'px');
            var starnumber;
            var evaluatebutton;

            function checkclass(state){
                if(state > 1){
                    return 'bid_contents';
                }else if(state == 1){
                    return 'bid_contentss';
                }else{
                    return 'bid_content';
                }
            }

            function loadundonebidorder(){
                if (isLoadingundonebidhistory) return;
                isLoadingundonebidhistory = true;
                var limit = $('#bidhistory_info .bid_contentss').length + ',' + 20;
                $.getJSON('/com/search_myundonebid.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            undonebidinfo[undonebidinfo.length] = json[i];                            
                        }
                        $('#bidhistory_info').append(dot_bid_order(json));
                    }else{
                        isEndundonebidhistory = true;
                    }
                    isLoadingundonebidhistory = false;
                })
            }

            function loadsuccessbidorder(){
                if (isLoadingbidhistory) return;
                isLoadingbidhistory = true;
                var limit = $('#bidhistory_info .bid_contents').length + ',' + 20;
                $.getJSON('/com/search_mysuccessbid.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            successbidinfo[successbidinfo.length] = json[i];                            
                        }
                        $('#bidhistory_info').append(dot_bid_order(json));
                    }else{
                        isEndbidhistory = true;
                    }
                    isLoadingbidhistory = false;
                })
            }

            function loadfailurebidorder(){
                if (isLoadingfailurebidhistory) return;
                isLoadingfailurebidhistory = true;
                var limit = $('#bidhistory_info .bid_content').length + ',' + 20;
                $.getJSON('/com/search_myfailurebid.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            failurebidinfo[failurebidinfo.length] = json[i];                            
                        }
                        $('#bidhistory_info').append(dot_bid_order(json));
                    }else{
                        isEndfailurebidhistory = true;
                    }
                    isLoadingfailurebidhistory = false;
                })
            }

            function loadoverbidorder(){
                if (isLoadingoverbidhistory) return;
                isLoadingoverbidhistory = true;
                var limit = $('#bidhistory_info .bid_content').length + ',' + 20;
                $.getJSON('/com/search_myoverbid.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            overbidinfo[overbidinfo.length] = json[i];                            
                        }
                        $('#bidhistory_info').append(dot_bid_order(json));
                    }else{
                        isEndoverbidhistory = true;
                    }
                    isLoadingoverbidhistory = false;
                })
            }

            $('#bidhistory_info').scroll(function(){
                if($('.checked').hasClass('successbid')){
                    if (isLoadingbidhistory || isEndbidhistory) return;
                    var scrollHeight = $(this)[0].scrollHeight;
                    var scrollTop = $(this)[0].scrollTop;
                    var elementHight = $(this).height();
                    if(scrollTop + elementHight >= scrollHeight-100) {
                        loadsuccessbidorder();
                    } 
                }else if($('.checked').hasClass('failurebid')){
                    if (isLoadingfailurebidhistory || isEndfailurebidhistory) return;
                    var scrollHeight = $(this)[0].scrollHeight;
                    var scrollTop = $(this)[0].scrollTop;
                    var elementHight = $(this).height();
                    if(scrollTop + elementHight >= scrollHeight-100) {
                        loadfailurebidorder();
                    } 
                }else if($('.checked').hasClass('undone')){
                    if (isEndundonebidhistory || isLoadingundonebidhistory) return;
                    var scrollHeight = $(this)[0].scrollHeight;
                    var scrollTop = $(this)[0].scrollTop;
                    var elementHight = $(this).height();
                    if(scrollTop + elementHight >= scrollHeight-100) {
                        loadundonebidorder();
                    } 
                }
            })

            $('.successbid').click(function(){
                $(this).addClass('checked').siblings('.checked').removeClass('checked');
                $('#bidhistory_info').html('');
                if(successbidinfo.length > 10){
                    $('#bidhistory_info').append(dot_bid_order(successbidinfo));
                }else{
                    loadsuccessbidorder();
                }
            })
            $('.failurebid').click(function(){
                $(this).addClass('checked').siblings('.checked').removeClass('checked');
                $('#bidhistory_info').html('');
                if(failurebidinfo.length > 10){
                    $('#bidhistory_info').append(dot_bid_order(failurebidinfo));
                }else{
                    loadfailurebidorder();
                }
            })

            $('.overbid').click(function(){
                $(this).addClass('checked').siblings('.checked').removeClass('checked');
                $('#bidhistory_info').html('');
                if(overbidinfo.length > 10){
                    $('#bidhistory_info').append(dot_bid_order(overbidinfo));
                }else{
                    loadoverbidorder();
                }
            })

            $('.undone').click(function(){
                $(this).addClass('checked').siblings('.checked').removeClass('checked');
                $('#bidhistory_info').html('');
                if(undonebidinfo.length > 10){
                    $('#bidhistory_info').append(dot_bid_order(undonebidinfo));
                }else{
                    loadundonebidorder();
                }
            })

            $('#bidhistory_info').on('click','.bid_contents .tenderuserinfo',function(){
                var that = $(this);
                var thatclass = that.parent().find('.orderinfos');
                if(that.parent().hasClass('shownow')){
                    thatclass.css('height','0');
                    that.parent().removeClass('shownow');
                    thatclass.html('');
                }else{
                    $('.orderinfos').html('');
                    $('.shownow .orderinfos').css('height','0');
                    that.parent().siblings('.bid_contents').removeClass('shownow');
                    var state = that.parent().data('state');
                    if(state > 1){
                        that.parent().addClass('shownow');
                        var userid = that.parent().data('userid');
                        var orderid = that.parent().data('orderid');
                        $.getJSON('/com/search_orderuserinfo.php',{userid:userid,orderid:orderid},function(json){
                            if(json){
                                that.parent().find('.orderinfos').append('<div class="orderinfos_username">'+json.name+'</div><a href="tel:'+json.phone+'" class="orderinfos_userphone">'+json.phone+'</a><div class="orderinfos_info">订单名称：'+json.ordername+'</div><div class="orderinfos_info">用苗地：'+json.address+'</div>');
                                that.parent().find('.orderinfos').css('height','auto');
                            }
                        })
                    }
                    
                }
            });
            
            

            $('#bidhistory_info').on('click','.bid_detail',function(e){
                $('.box').remove();
                var serial = $(this).parents('.bid_contents').data('serial');
                if($('.overbid').hasClass('checked')){
                    for (var i = 0; i < overbidinfo.length; i++) {
                        if(overbidinfo[i].serial_number == serial){
                            $('#alert').append(makeprocess(overbidinfo[i]));           
                        }
                    }
                }else{
                    for (var i = 0; i < successbidinfo.length; i++) {
                        if(successbidinfo[i].serial_number == serial){
                            $('#alert').append(makeprocess(successbidinfo[i]));      
                        }
                    }
                }
                $('#process').show();
            });

            function makeprocess(one){
                var str = '';
                var orderbytime = [];
                orderbytime[0] = 'orderstart_time';
                for (var i = 1; i < timearray.length; i++) {
                    if(one[timearray[i]]){
                        orderbytime[orderbytime.length] = timearray[i];
                    }
                }
                for(var i=0;i<orderbytime.length;i++){
                    for(var j=i;j<orderbytime.length;j++){
                        if(one[orderbytime[i]] <= one[orderbytime[j]]){
                            var tmp=orderbytime[i];
                            orderbytime[i]=orderbytime[j];
                            orderbytime[j]=tmp;
                        }
                    }
                }
                for (var i = 0; i < orderbytime.length; i++) {
                    if(timeimpact[orderbytime[i]]){
                        str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[orderbytime[i]]+'：'+one[timeimpact[orderbytime[i]]]/100+'元</div><div>'+one[orderbytime[i]]+'</div></div></div>'; 
                    }else{
                        str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[orderbytime[i]]+'</div><div>'+one[orderbytime[i]]+'</div></div></div>';
                    }                        
                }
                return str;
            }

            $('#bidhistory_info').on('click','.bid_contentss .tenderuserinfo',function(){
                var that = $(this);
                var thatclass = that.parent().find('.orderinfos');
                if(that.parent().hasClass('shownow')){
                    thatclass.css('height','0');
                    that.parent().removeClass('shownow');
                    thatclass.html('');
                }else{
                    $('.orderinfos').html('');
                    $('.shownow .orderinfos').css('height','0');
                    that.parent().siblings('.bid_contentss').removeClass('shownow');
                    var state = that.parent().data('state');
                    if(state == 1){
                        that.parent().addClass('shownow');
                        var userid = that.parent().data('userid');
                        var orderid = that.parent().data('orderid');
                        $.getJSON('/com/search_unfinshedorderuserinfo.php',{userid:userid,orderid:orderid},function(json){
                            if(json){
                                that.parent().find('.orderinfos').append('<div class="orderinfos_info">'+json.name+'</div><div class="orderinfos_info">订单名称：'+json.ordername+'</div>');
                                that.parent().find('.orderinfos').css('height','auto');
                            }
                        })
                    }
                }
            });
            $('#process').click(function(){
                $('#process').hide();  
            })

            $('#bidhistory_info').on('click','.agree',function(e){
                var edit = confirm('确定退款！');
                if(!edit) return;
                var that = $(this);
                var serial = that.parents('.bid_contents').data('serial');                
                $.getJSON('/wxpay/example/orders_agreerefund.php',{serial:serial},function(json){ 
                    if(json){
                        var newsucc = [];
                        for (var i = 0; i < successbidinfo.length; i++) {
                            if(successbidinfo[i].serial_number == serial){
                                successbidinfo[i].refund_time = json.refund_time;
                                successbidinfo[i].refund_mount = json.refund_mount;
                                successbidinfo[i].state = 18;
                                successbidinfo[i].order_switch = 10;
                                successbidinfo[i].deposit_switch = 2;
                                overbidinfo[overbidinfo.length] = successbidinfo[i];
                            }else{
                                newsucc[newsucc.length] = successbidinfo[i];
                            }                            
                        }
                        successbidinfo = newsucc;
                        that.parents('.bid_contents').remove();
                    }
                })
            });

            $('#bidhistory_info').on('click','.button_applydeposit',function(e){
                var that = $(this);
                var userid = that.parent().data('userid');
                var serial = that.parent().data('serial');                
                var id = that.parent().data('id');                
                var orderid = that.parent().data('orderid');                
                $.get('/com/orders_applydeposit.php',{serial:serial,userid:userid,id:id,orderid:orderid,biduserid:user.userid},function(json){ 
                    if(json){
                        that.addClass('button_over').removeClass('button_applydeposit');
                        that.html('等待付定金');
                    }
                })
            });

            $('#bidhistory_info').on('click','.bid_content_evaluate',function(){
                $('.evaluate_content').show();
                evaluatebutton = $(this);
            })


            $('.showstar').click(function(){
                var starsn = $(this).attr('state');
                $('.starover').removeClass('starover');
                starsn = parseInt(starsn);
                starnumber = 0;
                for (var i = 0; i < starsn; i++) {
                    starnumber = 1+i;
                    $('.star'+starnumber).addClass('starover');
                }
            })

            $('#evaluate_upload').click(function(){
                if(starnumber > 0){
                    var evaluate_text = $('#evaluate_text').val();
                    var tenderuserid = evaluatebutton.parent().attr('data-userid');
                    var id = evaluatebutton.parent().attr('data-id');
                    $.getJSON('/com/shop_evaluates.php',{evaluate:evaluate_text,tenderuserid:tenderuserid,userid:user.userid,starnumber:starnumber,id:id},function(result){
                        if(result){
                            $('#evaluate_text').val('');
                            starnumber = 0;
                            $('.evaluate_content').hide();
                            $('.starover').removeClass('starover');
                            evaluatebutton.remove();
                            alert('评价成功！');
                        }else{
                            alert('评价失败！');
                        }
                    })
                }else{
                    alert('请选择您的满意度！');
                }
            })

            $('#evaluate_reset').click(function(){
                $('#evaluate_text').val('');
                starnumber = 0;
                $('.evaluate_content').hide();
                $('.starover').removeClass('starover');
            })

            $('#bidhistory_info').on('click','.disagree',function(){
                var edit = confirm('确定不退款！');
                if(!edit) return;
                var that = $(this);
                var serial = that.parents('.bid_contents').data('serial');
                var id = that.parents('.bid_contents').data('id');
                $.get('/com/orders_disagreerefund.php',{serial:serial,id:id,userid:user.userid},function(result){ 
                    if(result){
                        for(var i = 0; i < successbidinfo.length; i++) {
                            if(successbidinfo[i].serial_number == serial){
                                successbidinfo[i].order_switch = 9;
                                successbidinfo[i].state = 16;
                            }                          
                        }
                        that.parent().find('.agree').remove();
                        that.addClass('button_over').removeClass('disagree');
                        that.html('正在协商');
                    }
                })
            });

            $('#bidhistory_info').on('click','.button_delivery',function(){
                var edit = confirm('确定发货！');
                if(!edit) return;
                var that = $(this);
                var serial = that.parents('.bid_contents').data('serial');
                var id = that.parents('.bid_contents').data('id');
                var userid = that.parents('.bid_contents').data('userid');
                var orderid = that.parents('.bid_contents').data('orderid');
                $.get('/com/orders_deliverytrees.php',{serial:serial,id:id,userid:user.userid,tender_userid:userid,orderid:orderid},function(result){ 
                    if(result){
                        for(var i = 0; i < successbidinfo.length; i++) {
                            if(successbidinfo[i].serial_number == serial){
                                successbidinfo[i].delivery_time = result;
                                successbidinfo[i].state = 12;
                            }                          
                        }
                        that.addClass('button_over').removeClass('button_delivery');
                        that.html('正在运输');
                    }
                })
            });
        </script>
    </script>
    <script type="text/html" id="tpl_current_order">
        <div class="page writeing">
            <div class="page__bd" id="current_orders">
                <div class="currentinfo">
                    <div class="createneworder">制作我的招标二维码</div>
                    <div id="order_table"></div>
                </div>                
                <!-- 菜单选项 -->
                <div id="menu">
                    <div class="menu_button deal_budget">导预算</div>
                    <div class="menu_button deal_purchase">导采购</div>
                    <div class="menu_button input_order">录清单</div>
                </div>
                <!-- 录入清单 -->
                <div id="attributein">
                    <div class="hidden_attributein">×</div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">苗木名称:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" id="name" placeholder="名称"/>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">数 量(株):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="count" placeholder="10"/>
                        </div>
                    </div>
                    <div id="trunk_diameter1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">胸 径(公分):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue2(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="trunk_diameter" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="ground_diameter1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">地 径(公分):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue2(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="ground_diameter" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="pot_diameter1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">盆 径(公分):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue2(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="pot_diameter" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="plant_height1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">株 高(米):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="plant_height" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="plant_height_cm1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">株 高(公分):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue4(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="plant_height_cm" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="crown1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">冠 幅(米):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="crown" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="crown_cm1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">冠 幅(公分):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue4(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="crown_cm" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="branch_number1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">分 枝 数(个):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue3(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="branch_number" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="bough_number1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">主 枝 数(个):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue3(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="bough_number" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="branch_length1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">条 长(米):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="branch_length" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="bough_length1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">主蔓(枝)长(米):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="bough_length" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="branch_point_height1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">分枝点高(米):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="branch_point_height" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="age1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">苗 龄(年):</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="age" placeholder="6或6-8"/>
                        </div>
                    </div>
                    <div id="substrate1" class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">基 质:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" id="substrate" placeholder="基质名称"/>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">备注:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" id="mark" placeholder="填写备注"/>
                        </div>
                    </div>
                    <div id="buttons">
                        <a class="weui-btn weui-btn_mini weui-btn_primary" id="reset">清空</a>
                        <a class="weui-btn weui-btn_mini weui-btn_primary" id="add">添加</a>
                    </div>
                </div>
                <div id="alertordername">
                    <div id="alertinfo">
                        <div style="text-align:center;margin:6% 0px;"><h3>输入新订单名称及用苗地点</h3></div>
                        <input type="text" id="order_name" class="form_control_alert" placeholder="订单名称">
                        <input type="text" id="tree_arrive_address" class="form_control_alert" placeholder="用苗地点">
                        <a class="weui-btn weui-btn_mini weui-btn_primary order_name_button_reset">取消</a>
                        <a class="weui-btn weui-btn_mini weui-btn_primary" id="order_name_button">提交</a>
                    </div>
                </div>
                <div id="alertuserphone">
                    <div class="alertrow1"><div class="alert_head">请填写手机号</div><div class="closealertphone" style="">×</div></div>
                    <div class="alertinput2">
                        <div class="alerttitle">手机号:</div><input type="number" id="alert_phone" class="alertcontent" placeholder="请输入您的手机号">
                    </div>
                    <div class="buttonbottom">
                        <button type="button" class="phone_button_reset">清空</button>
                        <button type="button" id="phone_button">提交</button>
                    </div>
                </div> 
                <div class="bigimages"><div id="bigimages"></div></div>
            </div>
        </div>
        
        <script type="text/javascript">
            $('.bigimages').css('width',windowwidth+'px');                    
            $('.bigimages').css('height',windowheight+'px'); 
            var provinces_name = ['安徽','北京','重庆','福建','甘肃','广东','广西','贵州','海南','河北','河南','黑龙江','湖北','湖南','山东','吉林','江苏','江西','辽宁','内蒙古','宁夏','青海','山西','陕西','上海','四川','天津','新疆','云南','浙江'];
            
            function hideattribute(){
                var dictionary_attributes = {5:'trunk_diameter',6:'ground_diameter',7:'pot_diameter',8:'age',9:'crown',10:'plant_height',11:'branch_length',12:'bough_length',13:'branch_point_height',14:'branch_number',15:"bough_number",17:'plant_height_cm',18:'crown_cm',19:'substrate'};
                for (var i = 5; i < 20; i++) {
                    $('#'+dictionary_attributes[i]+'1').hide();
                }
            }

            function checkistrue1(value){
                var value1 = value.split('-');
                var value2 = value.split('－');
                if((value1[0] > 20) || (value1[1] > 20)){
                    alert('此规格不可超过20米！');
                    return '';
                }
                if((value2[0] > 20) || (value2[1] > 20)){
                    alert('此规格不可超过20米！');
                    return '';
                }
                return value;
            }

            function checkistrue2(value){
                var value1 = value.split('-');
                var value2 = value.split('－');
                if((value1[0] > 100) || (value1[1] > 100)){
                    alert('此规格不可超过100公分！');
                    return '';
                }
                if((value2[0] > 100) || (value2[1] > 100)){
                    alert('此规格不可超过100公分！');
                    return '';
                }
                return value;
            }

            function checkistrue3(value){
                var value1 = value.split('-');
                var value2 = value.split('－');
                if((value1[0] > 10) || (value1[1] > 10)){
                    alert('此规格不可超过10个！');
                    return '';
                }
                if((value2[0] > 10) || (value2[1] > 10)){
                    alert('此规格不可超过10个！');
                    return '';
                }
                return value;
            }

            function checkistrue4(value){
                var value1 = value.split('-');
                var value2 = value.split('－');
                if((value1[0] > 500) || (value1[1] > 500)){
                    alert('此规格不可超过500公分！');
                    return '';
                }
                if((value2[0] > 500) || (value2[1] > 500)){
                    alert('此规格不可超过500公分！');
                    return '';
                }
                return value;
            }

            function loadunfinishedorder(){
                $.getJSON('/com/unfinished_order.php',{userid:user.userid,state:0},function(data){
                    if(data){
                        $("#order_table").append(dot_table_order(data));
                        loadprovincesaddress();
                        $('.tree_origin_name').html(provinces_namehtml);
                    }
                })
            }

            function loadprovincesaddress(){
                provinces_namehtml = '';
                for (var i = 0; i < provinces_name.length; i++) {
                    provinces_namehtml += '<label class="provinces_name" style="display:none"><input type="checkbox" value="'+provinces_name[i]+'">'+provinces_name[i]+'</label>';
                }
            }

            function loadunfinisheddata(orderid){
                if($('#order_table'+orderid).html()) return false;
                var html = '';
                $.getJSON('/com/order_temp_search.php',{userid:user.userid,orderid:orderid},function(json){
                    if(json){
                        data[orderid] = [];
                        var counts = 0;
                        for (var i = 0; i < json.length; i++) {
                            data[orderid][i] = json[i];
                            datan = 1+i;
                            var attr = attributes_show(json[i]);
                            attribute_shift(data[orderid][i]);
                            html += '<div class="table" id="'+json[i].id+'">';
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
                        selectarea(data[orderid]);
                        $('#order_table'+orderid).html(html);
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

            function selectarea(condition){
                $.getJSON('/com/search_price_batch.php',{data:JSON.stringify(condition)},function(json){
                    provinces[working] = [];
                    addressprice[working] = [];
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            provinces[working][i] = [];
                            addressprice[working][i] = {};
                            for (var y = 0; y < condition.length; y++) {
                                if(condition[y].id == json[i].id){
                                    addressprice[working][i].id = json[i].id;
                                    if(json[i].price){
                                        var p = 0;
                                        addressprice[working][i].price = [];
                                        for (var z = 0; z < json[i].price.length; z++) {
                                            addressprice[working][i].price[p] = json[i].price[z];
                                            provinces[working][i][p] = json[i].price[z].province;
                                            p++;
                                        }
                                    }else{
                                        addressprice[working][i].price = [];
                                        provinces[working][i] = '';
                                    }
                                }
                            }
                        }
                        var haves = [''];
                        for (var x = 0; x < provinces[working].length; x++) {
                            for (var z = 0; z < provinces[working][x].length; z++) {
                                var y = 0;
                                for (var i = 0; i < haves.length; i++) {
                                    if(haves[i] != provinces[working][x][z]){
                                        ++y;
                                    }
                                    if(y == haves.length){
                                        haves[haves.length] = provinces[working][x][z];
                                    }
                                }
                            }
                        }   
                        // 显示交集省份
                        $('.on .provinces_name').hide();
                        for (var i = 0; i < haves.length; i++) {
                            $('#tree_origin_name'+working+' input[type="checkbox"][value="'+haves[i]+'"]').parent().show();
                        }   
                    }
                });
            }

            function haveareacity(same){
                var areacity = '';
                pricescity[same] = [];
                for (var i = 0; i < addressprice[working].length; i++) {
                    if(addressprice[working][i]){
                        pricescity[same][i] = [];
                        var areaprice = addressprice[working][i].price;
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

            function mark(att){
                if(att){
                    if(att[1]){
                        return att[0]+'-'+att[1];
                    }else if(parseFloat(att[0]) > 0){
                        return att[0];
                    }
                }
            }

            function guige(content){
                var attr = '';
                if(parseFloat(content.trunk_diameter) > 0){
                    attr += ' 胸径:'+mark(content.trunk_diameter)+'公分';
                }
                if(parseFloat(content.ground_diameter) > 0){
                    attr += ' 地径:'+mark(content.ground_diameter)+'公分';
                }
                if(parseFloat(content.pot_diameter) > 0){
                    attr += ' 盆径:'+mark(content.pot_diameter)+'公分';
                }
                if(parseFloat(content.plant_height) > 0){
                    attr += ' 株高:'+mark(content.plant_height)+'米';
                }
                if(parseFloat(content.plant_height_cm) > 0){
                    attr += ' 株高:'+mark(content.plant_height_cm)+'公分';
                }
                if(parseFloat(content.crown) > 0){
                    attr += ' 冠幅:'+mark(content.crown)+'米';
                }
                if(parseFloat(content.crown_cm) > 0){
                    attr += ' 冠幅:'+mark(content.crown_cm)+'公分';
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
                    attr += ' 条长:'+mark(content.branch_length)+'米';
                }
                if(parseFloat(content.bough_length) > 0){
                    attr += ' 主蔓(枝)长:'+mark(content.bough_length)+'米';
                }
                if(parseFloat(content.branch_point_height) > 0){
                    attr += ' 分枝点高:'+mark(content.branch_point_height)+'米';
                }
                if(content.substrate != undefined){
                    attr += ' 基质:'+content.substrate;
                }
                if(content.mark != undefined){
                    attr += ' 备注:'+content.mark;
                }
                return attr;
            }

            function showprice(){
                finalkey[working] = [];                
                finalprice[working] = [];
                var allprice = [];
                var allareaprice = [];
                var shengfen = '';
                $('#tree_origin_name'+working+' input:checked').each(function() {
                    shengfen += $(this).val()+',';
                });
                shengfen = shengfen.substring(0,shengfen.length-1);
                var htmld = '';
                shengfen = shengfen.split(',');
                var countes = 0;
                for (var z = 0; z < shengfen.length; z++) {
                    allprice[z] = 0;
                }
                if(cities){
                    for (var q = 0; q < cities.length; q++) {
                        allareaprice[q] = 0;
                    } 
                }
                var y = 0;
                for (var i = 0; i < data[working].length; i++) {
                    if(data[working][i]){
                        y++;
                        var k = y - 1;
                        finalprice[working][k] = [];
                        var attr = '';
                        var attr = guige(data[working][i]);
                        var price = addressprice[working][i].price;
                        
                        htmld += '<div class="table" id="'+data[working][i].id+'">';
                        htmld += '<input type="hidden" name="id" class="id"  value="'+data[working][i].id+'">';
                        htmld += '<div class="table_order">'+y+'</div>';
                        htmld += '<div class="table_content">';
                        htmld += '<div class="table_row1_clos1">';
                        htmld += '<div class="tree_name">'+data[working][i].name+'</div>';
                        htmld += '<div class="tree_number">'+data[working][i].count+data[working][i].unit+'</div>';
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
                                    finalkey[working][finalkey[working].length] = shengfen[x];
                                    var z = 0;
                                    if((addressprice[working][i].price != null) && (addressprice[working][i].price.length > 0)){
                                        for (var m = 0; m < price.length; m++) {

                                            if(price[m].province == shengfen[x]){
                                                htmld += '<td class="addressprice_price">'+(price[m].avg).toFixed(0)+'</td>';
                                                finalprice[working][k][finalprice[working][k].length] = price[m].avg;
                                            }else{
                                                ++z;
                                            }
                                            if(z == price.length){
                                                htmld += '<div class="addressprice_price">0</div>';
                                                finalprice[working][k][finalprice[working][k].length] = 0;
                                            }
                                        }
                                    }else{
                                        htmld += '<div class="addressprice_price">0</div>';
                                        finalprice[working][k][finalprice[working][k].length] = 0;
                                    }
                                    htmld += '</div>';
                                }
                            }
                        }
                        if(cities){
                            for (var z = 0; z < shengfen.length; z++) {
                                for (var q = 0; q < cities.length; q++) {

                                    var parentss = $('input[value='+cities[q]+']').parents('.tree_arrive_address_citys').find('.area_city').html();
                                    if(parentss){
                                        parentss = parentss.substring(0,parentss.length-1);
                                        if(parentss == shengfen[z]){
                                            htmld += '<div class="table_row1_clos2_data">';
                                            htmld += '<div class="addressprice_address">'+cities[q]+'</div>';
                                            finalkey[working][finalkey[working].length] = cities[q];
                                            if(pricescity[shengfen[z]][i][cities[q]] != undefined){
                                                var pricesss = pricescity[shengfen[z]][i][cities[q]];
                                                if(pricesss){
                                                    htmld += '<td class="addressprice_price">'+pricesss+'</td>';
                                                    finalprice[working][k][finalprice[working][k].length] = pricesss;
                                                }else if(sohard[shengfen[z]][cities[q]]){
                                                    htmld += '<div class="addressprice_price">0</div>';
                                                    finalprice[working][k][finalprice[working][k].length] = 0;
                                                }
                                            }else{
                                                htmld += '<div class="addressprice_price">0</div>';
                                                finalprice[working][k][finalprice[working][k].length] = 0;
                                            }
                                            htmld += '</div>';                                        
                                        }
                                        
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
                $('#order_table'+working).html();
                $('#order_table'+working).html(htmld);
            }

            function findname(){
                var name = $('#name').val();
                if(name){
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
                }
            }

            function reset(){
                var rightbtnname = $('#reset').html();
                if(rightbtnname == '清空'){
                    $('#attributein input').val('');
                }else{
                    var deleteid = data[working][editen]['id'];
                    editen = -1;
                    // 删除数据
                    $.get('/com/order_temp_deleteall.php',{userid:user.userid, id:deleteid},function(result){
                        if(result){
                            var deleteoverdata = [];
                            var deleteoveraddressprice = [];
                            var deleteoverprovinces = [];

                            for (var i = 0; i < data[working].length; i++) {
                                if(data[working][i].id != deleteid){
                                    deleteoverdata[deleteoverdata.length] = data[working][i];
                                    deleteoveraddressprice[deleteoveraddressprice.length] = addressprice[working][i];
                                    deleteoverprovinces[deleteoverprovinces.length] = provinces[working][i];
                                }
                            }
                            data[working] = deleteoverdata;
                            addressprice[working] = deleteoveraddressprice;
                            provinces[working] = deleteoverprovinces;
                            var haves = [''];
                            for (var x = 0; x < provinces[working].length; x++) {
                                for (var z = 0; z < provinces[working][x].length; z++) {
                                    var y = 0;
                                    for (var i = 0; i < haves.length; i++) {
                                        if(haves[i] != provinces[working][x][z]){
                                            ++y;
                                        }
                                        if(y == haves.length){
                                            haves[haves.length] = provinces[working][x][z];
                                        }
                                    }
                                }
                            }
                            $('#tree_origin_name'+working+' .provinces_name').hide();
                            for (var i = 0; i < haves.length; i++) {
                                $('#tree_origin_name'+working+' input[type="checkbox"][value="'+haves[i]+'"]').parent().show();
                            }   

                            $('#tree_origin_name'+working+' input:checked').each(function() {
                                    $(this).prop("checked",false);
                            });

                            $('#tree_arrive_address_city'+working).html('');

                        }
                        showprice();
                        $('#attributein input').val('');
                        hideattribute();
                        $('#add').html('添加');
                        $('#reset').html('清空');
                    });
                }
            }

            function showattributeindex() {
                var content = data[working][editen];
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

            function attributeedite(){
                var content = data[working][editen];
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
                $('#name').focus();
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
                $('#mark').val((content.mark) ? content.mark : '');
            }

            function join(req){
                if(req){
                    if(req[1]){
                        return req[0]+'-'+req[1];
                    }else{
                        return req[0];
                    }
                }else{
                    return '';
                }
            }

            function toadd(){
                var caozuo = $('#add').html();
                var content = {};
                if($.trim($('#name').val())!='') content.name = $.trim($('#name').val());
                if($.trim($('#trunk_diameter').val())!='') content.trunk_diameter = sort($.trim($('#trunk_diameter').val()));
                if($.trim($('#plant_height').val())!='') content.plant_height = sort($.trim($('#plant_height').val()));
                if($.trim($('#crown').val())!='') content.crown = sort($.trim($('#crown').val()));
                if($.trim($('#branch_point_height').val())!='') content.branch_point_height = sort($.trim($('#branch_point_height').val()));
                if($.trim($('#branch_number').val())!='') content.branch_number = sort($.trim($('#branch_number').val()));
                if($.trim($('#ground_diameter').val())!='') content.ground_diameter = sort($.trim($('#ground_diameter').val()));
                if($.trim($('#bough_number').val())!='') content.bough_number = sort($.trim($('#bough_number').val()));
                if($.trim($('#plant_height_cm').val())!='') content.plant_height_cm = sort($.trim($('#plant_height_cm').val()));
                if($.trim($('#crown_cm').val())!='') content.crown_cm = sort($.trim($('#crown_cm').val()));
                if(($.trim($('#age').val())!='') && ($('#age').val() != 'undefined')) content.age = sort($.trim($('#age').val()));
                if($.trim($('#branch_length').val())!='') content.branch_length = sort($.trim($('#branch_length').val()));
                if($.trim($('#pot_diameter').val())!='') content.pot_diameter = sort($.trim($('#pot_diameter').val()));
                if($.trim($('#bough_length').val())!='') content.bough_length = sort($.trim($('#bough_length').val()));
                if($.trim($('#substrate').val())!='') content.substrate = $.trim($('#substrate').val());
                if($.trim($('#mark').val())!='') content.mark = $.trim($('#mark').val());
                if($.trim($('#count').val())!='') content.count = $.trim($('#count').val());

                if((content.count != null) && (content.name != null)){
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
                            content.id = randomget();
                            $.get('/com/order_temp_add.php',{uid:user.userid, data:JSON.stringify(content),orderid:working},function(result){
                                if(result){
                                    screenaddress(content);
                                    data[working][data[working].length] = content;
                                }
                            });
                        }else{
                            content.id =  dataid;
                            data[working][editen] = content;
                            $('#add').html('添加');
                            $('#reset').html('清空');
                            $.get('/com/order_temp_update.php',{uid:user.userid, data:JSON.stringify(content)},function(result){
                                if(result) screenaddress(content);
                            });
                        }
                }else{
                    alert('名称或数量未填写');
                }
            }

            function randomget(){
                var number = '';
                var mydate = new Date();
                number += mydate.getFullYear();
                var Month = mydate.getMonth()+1;
                if(Month < 10) Month = '0'+ Month;
                number += Month;

                var day = mydate.getDate();
                if(day < 10) day = '0'+ day;
                number += day;

                var Hours = mydate.getHours();
                if(Hours < 10) Hours = '0'+ Hours;
                number += Hours;

                var Minutes = mydate.getMinutes();
                if(Minutes < 10) Minutes = '0'+ Minutes;
                number += Minutes;

                var Seconds = mydate.getSeconds();
                if(Seconds < 10) Seconds = '0'+ Seconds;
                number += Seconds;

                var Milliseconds = mydate.getMilliseconds();
                if(Milliseconds < 10){
                    Milliseconds = '00'+ Milliseconds;
                }else if(Milliseconds < 100){
                    Milliseconds = '0'+ Milliseconds;
                } 
                number += Milliseconds;

                return number;
            }

            function screenaddress(tiaojian){
                $.getJSON('/com/search_price.php',{data:JSON.stringify(tiaojian)},function(json){
                    if(json){
                        var info = json.price;
                        // 将省份信息给addressprice数组
                        if(editen > -1){
                            addressprice[working][editen] = json;
                            editen = -1;
                        }else{
                            addressprice[working][addressprice[working].length] = json;
                        }
                        if(json.price){
                            var infoprovinces = [];
                            // 获取省份信息给provinces数组中
                            for (var i = 0; i < info.length; i++) {
                                infoprovinces[i] = info[i].province;
                            }
                            provinces[working][provinces[working].length] = infoprovinces;
                        }
                            var haves = [];
                            for (var x = 0; x < provinces[working].length; x++) {
                                for (var z = 0; z < provinces[working][x].length; z++) {
                                    var y = 0;
                                    if(haves.length>0){
                                        for (var i = 0; i < haves.length; i++) {
                                            if(haves[i] != provinces[working][x][z]){
                                                ++y;
                                            }
                                            if(y == haves.length){
                                                haves[haves.length] = provinces[working][x][z];
                                            }
                                        }
                                    }else{                                        
                                        haves[0] = provinces[working][x][z];
                                    }
                                }
                            }   

                            $('#tree_origin_name'+working+' .provinces_name').hide();
                            $('.tree_arrive_address_citys').hide();
                            $('input[type="checkbox"]').prop("checked",false);
                            cities = '';
                            fatherprivious = '';
                            pricescity = [];
                            sohard = [];
                            for (var i = 0; i < haves.length; i++) {
                                $('#tree_origin_name'+working+' input[type="checkbox"][value="'+haves[i]+'"]').parent().show();
                            }   
                            showprice();
                    }
                });
            }

            function sort(req){
                return req.replace('－','-').replace('。','.').replace('一','-').replace('_','-').split('-');
            }

            function final_deal(){
                var finalallprice = [];
                var as = 0;
                for (var x = 0; x < data[working].length; x++) {
                    if(data[working][x]){
                        finalallprice[as] = {};
                        finalallprice[as].id = data[working][x].id;
                        as++;
                    }
                }
                if(finalkey && finalkey[working] && finalkey[working].length){
                    var sss = finalkey[working].length/finalprice[working].length;
                    for (var x = 0; x < finalprice[working].length; x++) {
                        for (var i = 0; i < sss; i++) {
                            finalallprice[x][finalkey[working][i]] = finalprice[working][x][i];
                        }
                    }
                    var newdata = 0;
                    var typedata = [];
                    var typeaddressprices = finalallprice;
                    for (var i = 1; i < 12; i++) {
                        for (var x = 0; x < data[working].length; x++) {
                            if((data[working][x].type == i) && data[working][x]){
                                typedata[newdata] = data[working][x];
                                newdata++;
                            }
                        }
                    }
                }else{
                    var newdata = 0;
                    var typedata = [];
                    var typeaddressprices = 1;
                    for (var i = 1; i < 12; i++) {
                        for (var x = 0; x < data[working].length; x++) {
                            if((data[working][x].type == i) && data[working][x]){
                                typedata[newdata] = data[working][x];
                                newdata++;
                            }
                        }
                    }
                }   
                
                datas = JSON.stringify(typedata);
                addresspricess = JSON.stringify(typeaddressprices);
            }

            $('#order_table').on('click','.ordertitle_ordername',function(){
                if($(this).parents('.order').hasClass('on')){
                    $(this).parents('.order').removeClass('on');
                    $('#order_table .ordercontent').css('height','0');
                    $('#order_table .ordercontent').hide();                    
                    working = 0;
                    $('#attributein').hide();
                }else{
                    working = $(this).parents('.order').attr('id');
                    $('#order_table .order').removeClass('on');
                    $(this).parents('.order').addClass('on');
                    $(this).parents('.order').find('.ordercontent').show();
                    $(this).parents('.order').find('.ordercontent').css('height','auto');
                    $(this).parents('.order').siblings().find('.ordercontent').css('height','0');
                    $(this).parents('.order').siblings().find('.ordercontent').hide();
                    loadunfinisheddata(working);
                    $('#attributein').show();
                    $('#name').focus();
                }
            })

            $('#order_table').on('change','.provinces_name',function(){
                var areahtml = '';
                var shengfen = '';
                $('#tree_origin_name'+working+' input:checked').each(function() {
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
                    $('#tree_arrive_address_city'+working).html(areahtml);
                }else{
                    $('#tree_arrive_address_city'+working).html('');
                }
                if(cities){
                    for (var i = 0; i < cities.length; i++) {
                        $('#tree_arrive_address_city'+working+' input[value='+cities[i]+']').attr('checked','checked');
                    }
                }

                showprice();
            });

            $('.phone_button_reset').click(function(){
                $('#alert_phone').val('');
            })

            $('.closealertphone').click(function(){
                $('#alertuserphone').hide();
            })

            $('#order_table').on('change','.city_bn',function(){
                var fouk = '';
                var cityes = '';
                $('#tree_arrive_address_city'+working+' input:checked').each(function() {
                    cityes += $(this).val()+',';
                    fouk += $(this).parents('.tree_arrive_address_citys').find('.area_city').html();
                });
                if(cityes){
                    cityes = cityes.substring(0,cityes.length-1);
                    cities = cityes.split(',');
                }else{
                    cities = '';
                }
                if(fouk.length > 0){
                    fouk = fouk.substring(0,fouk.length-1);
                    fouk = fouk.split(':');
                }
                fatherprivious = fouk;
                showprice();
            });

            $('#order_table').on('click','.join_order',function(){
                    if(!data[working].length){
                        alert('请先完善采购单');
                        return false;
                    }
                    if(user.phone){
                        var edit = confirm('确定支付招标费用'+data[working].length+'元？');
                        if(edit){
                            tendering();                  
                        } 
                    }else{
                        $('#alertuserphone').show();
                        $('#alert_phone').focus();
                    }
            });

            $('.deal_budget').click(function(){                
                if(!data[working].length){
                    alert('请先完善采购单');
                    return false;
                }
                final_deal();
                window.location = '/com/budgetexcel.php?userid='+user.userid+'&orderid='+working+'&addressprices='+addresspricess;
            });

            $('.bigimages').click(function(){
                $('.bigimages').hide();
                window.location = './yusuanphone.php';
            })

            function checkPhone(){ 
                var phone = $('#alert_phone').val();
                if(!(/^1[34578]\d{9}$/.test(phone))){ 
                    alert("手机号码有误，请重填");  
                    return false; 
                }else{
                    return true; 
                }
            }

            $('#phone_button').click(function(){
                if(checkPhone()){
                    $.getJSON('/com/update_userphone.php',{phone:phone,userid:user.userid},function(result){
                        if(result){
                            $('#alertuserphone').hide(); 
                            var edit = confirm('确定支付招标费用'+data[working].length+'元？');
                            if(edit){
                                tendering();                  
                            } 
                        }
                    })
                }
            })

            function tendering(){
                final_deal();
                $.post('/com/order_insert.php',{uid:user.userid, addressprices:addresspricess, orderid:working},function(json){  
                    if(json == -1){
                        alert('支付失败!您的账户余额不足,请充值!');
                        window.location = "./recharge.php";
                    }else{                                    
                        alert('成功支付'+data[working].length+'元!');                                
                        $('#order_table .on').remove();
                        working = 0;
                        if($('#mytendermark').css("display") == 'none'){
                            var num = 1;
                            $('#mytendermark').show();
                            $('#mytendermarking').show();
                        }else{
                            var num = parseInt($('#mytendermark').html()) + 1;
                        }
                            
                        $('#mytendermark').html(num);
                        $('#mytendermarking').html(num);
                     

                        $('#bigimages').html('');
                        $('<img>').addClass('bigimage').attr('src','./tenderimage/'+json+'.jpg').appendTo('#bigimages');
                        $('.bigimages').show();
                    }
                });
            }

            $('.deal_purchase').click(function(){
                if(!data[working].length){
                    alert('请先完善采购单');
                    return false;
                }else{
                    final_deal();
                    window.location = '/com/purchaseexcel.php?userid='+user.userid+'&orderid='+working+'&addressprices='+addresspricess;
                }
            });

            $('.input_order').click(function(){
                if(working){
                    $('#attributein').show();
                    $('#name').focus();
                }else{
                    alert('请先选定您要录入的订单!');
                }
            })

            $('#name').blur(function(){
                findname();
            })

            $('#reset').click(function(){
                reset();
            })

            $('.hidden_attributein').click(function(){
                $('#attributein').hide();
                editen = -1;
                $('#attributein input').val('');
                hideattribute();
                $('#add').html('添加');
                $('#reset').html('清空');
            })

            $('#order_table').on("click",".table",function(){
                $('.colorinfo').removeClass('colorinfo');
                $(this).addClass('colorinfo');
                dataid = $(this).attr('id');
                for (var i = 0; i < data[working].length; i++) {
                    if(data[working][i].id == dataid){
                        editen = i;
                    }
                }
                if(snake == dataid){
                    showattributeindex();
                }else{
                    snake = dataid;
                    attributeedite();
                }
            })

            $('#add').click(function(){
                toadd();
                $('#name').focus();
            })

            $('.createneworder').click(function(){
                $('#alertordername').show();
                $('#order_name').focus();

                $('#order_table .order').removeClass('on');
                $('#order_table .ordercontent').css('height','0');
                $('#order_table .ordercontent').hide();                    
                working = 0;
                $('#attributein').hide();
            })

            $('.order_name_button_reset').click(function(){
                $('#alertordername').hide();
                $('#order_name_button').removeAttr('data-orderid');
                $('#order_name').val('');
            })

            $('#order_name_button').click(function(){
                var ordername = $.trim($('#order_name').val());
                var detailed_address = $.trim($('#tree_arrive_address').val());
                if(ordername && (detailed_address.length > 1)){
                    $.post('/com/create_neworder.php',{userid:user.userid,ordername:ordername,address:detailed_address},function(result){
                        if(result){
                            $('#alertordername').hide();
                            var newdataorder = [{id:result,ordername:ordername,address:detailed_address}];
                            $("#order_table").append(dot_table_order(newdataorder));
                            $('#tree_origin_name'+result).html(provinces_namehtml);
                            working = result;
                            data[working] = [];
                            addressprice[working] = [];
                            provinces[working] = [];
                            $('#'+result).addClass('on');
                            $('#'+result).find('.ordercontent').show();
                            $('#'+result).find('.ordercontent').css('height','auto');
                            $('#attributein').show();
                            $('#name').focus();
                            $('#order_name').val('');
                            $('#tree_arrive_address').val('');
                        }
                    })
                }else{
                    alert('请完善信息！');
                }
            })

            $('#order_table').on('click','.on .title_delete',function(){
                var id = $(this).parents('.on').attr('id');
                var that = $(this);
                $('#attributein').hide();
                $.getJSON('/com/order_temp_delete.php',{orderid:id},function(result){
                    if(result){
                        that.parents('.on').remove(); 
                    } 
                })
            })

            loaddictionary();
            hideattribute();
            loadprovincesaddress();
            loadunfinishedorder();
            $('#alertordername').show();
            $('#order_name').focus(); 

            function getTitle () {
                return '找树网招标集采入口';
            }
            function getImageUrl(){
                return 'http://cnzhaoshu.com/img/hall.jpg';
            }

            function getLink(){
                return 'http://cnzhaoshu.com/yusuanphone.php#current_order';
            } 
              

            function getDescription () {
                return '制作我的采购二维码';                     
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
    </script>
    <script type="text/html" id="tpl_managerbuy">
        <div class="page">
            <div class="page__bd">
                <div class="weui-tab">
                    <div class="headtitle1">
                        <div class="topbutton checked unfinshed">
                            未完成
                        </div>
                        <div class="topbutton finshed">
                            已完成
                        </div>
                    </div>
                    <div id="orderinfo">
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var timearray = ['orderstart_time','deposit_time','deposit_refund_time','fullamount_time','delivery_time','receipt_time','order_switch_time','refund_time','payment_time'];
            var timeimpact = { 
                deposit_time: "deposit", 
                deposit_refund_time: "deposit", 
                fullamount_time: "fullamount", 
                refund_time: "refund_mount"
            };
            
            var timename = {
                orderstart_time: "下订单",
                deposit_time: "已付定金",
                deposit_refund_time: "卖家收到定金",
                fullamount_time: "已付全款",
                delivery_time: "卖家已发货",
                receipt_time: "确认收货",
                payment_time: "交易完成",
                refund_time: "退还资金",
                order_switch_time: "申请退款"
            }
            var buy_isloadunfinshed = false;
            var buy_isendunfinshed = false;
            var buy_isloadfinshed = false;
            var buy_isendfinshed = false;
            var buy_unfinsheddata = [];
            var buy_finsheddata = [];
            var buy_alldata = [];
            var starnumber;
            var evaluatebutton;
            $('#orderinfo').css('height',(windowheight-60)+'px');
            function loadunfinshed(){
                if (buy_isloadunfinshed) return;
                buy_isloadunfinshed = true;
                var limit = $('#orderinfo .buy_onedatainfo').length + ',' + 10;
                $.getJSON('/com/search_order_oneunfinshedbuy.php', {userid:user.userid,limit:limit}, function(json) {
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            var mark =true;
                            for (var j = 0; j < buy_unfinsheddata.length; j++) {
                                if(buy_unfinsheddata[j].id == json[i].id){
                                  mark = false;  
                                } 
                            }
                            if(mark){
                                buy_unfinsheddata[buy_unfinsheddata.length] = json[i];
                                buy_alldata[buy_alldata.length] = json[i];
                            } 
                            var news = [];
                            news[0] = json[i];
                            $('#orderinfo').append(dot_onedatabuy(news));
                        }

                    }else{
                        buy_isendunfinshed = true;
                    }
                    buy_isloadunfinshed = false;
                });
            }

            function loadfinshed(){
                if (buy_isloadfinshed) return;
                buy_isloadfinshed = true;
                var limit = $('#orderinfo .buy_onedatainfo').length + ',' + 10;
                $.getJSON('/com/search_order_onefinshedbuy.php', {userid:user.userid,limit:limit}, function(json) {
                    if(json){
                            
                        for (var i = 0; i < json.length; i++) {
                            var mark =true;
                            for (var j = 0; j < buy_finsheddata.length; j++) {
                                if(buy_finsheddata[j].id == json[i].id){
                                  mark = false;  
                                } 
                            }
                            if(mark){
                                buy_finsheddata[buy_finsheddata.length] = json[i];
                                buy_alldata[buy_alldata.length] = json[i];
                            } 
                            var news = [];
                            news[0] = json[i];
                            $('#orderinfo').append(dot_onedatabuy(news));
                        }
                    }else{
                        buy_isendfinshed = true;
                    }
                    buy_isloadfinshed = false;
                    
                });
            }

            function makeprocess(one){
                var str = '';
                var orderbytime = [];
                orderbytime[0] = 'orderstart_time';
                for (var i = 1; i < timearray.length; i++) {
                    if(one[timearray[i]]){
                        orderbytime[orderbytime.length] = timearray[i];
                    }
                }
                for(var i=0;i<orderbytime.length;i++){
                    for(var j=i;j<orderbytime.length;j++){
                        if(one[orderbytime[i]] <= one[orderbytime[j]]){
                            var tmp=orderbytime[i];
                            orderbytime[i]=orderbytime[j];
                            orderbytime[j]=tmp;
                        }
                    }
                }
                for (var i = 0; i < orderbytime.length; i++) {
                    if(timeimpact[orderbytime[i]]){
                        str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[orderbytime[i]]+'：'+one[timeimpact[orderbytime[i]]]/100+'元</div><div>'+one[orderbytime[i]]+'</div></div></div>'; 
                    }else{
                        str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[orderbytime[i]]+'</div><div>'+one[orderbytime[i]]+'</div></div></div>';
                    }                        
                }
                return str;
            }

            $('#orderinfo').scroll(function() {
                var that = $(this);
                if($('.checked').hasClass('unfinshed')){
                    if (buy_isendunfinshed || buy_isloadunfinshed) return;
                    var scrollHeight = that[0].scrollHeight;
                    var scrollTop = that[0].scrollTop;
                    var elementHight = that.height();
                    if(scrollTop + elementHight >= scrollHeight-150) {
                        loadunfinshed();
                    } 
                }else{
                    if (buy_isendfinshed || buy_isloadfinshed) return;
                    var scrollHeight = that[0].scrollHeight;
                    var scrollTop = that[0].scrollTop;
                    var elementHight = that.height();
                    if(scrollTop + elementHight >= scrollHeight-150) {
                        loadfinshed();
                    }
                } 
            })

            $('#orderinfo').on('click','.info',function(){
                window.location = 'http://cnzhaoshu.com';
            })

            $('.unfinshed').click(function(){
                $('#orderinfo').html('');
                $('.checked').removeClass('checked');
                $(this).addClass('checked');
                if(buy_unfinsheddata.length > 10){
                    $('#orderinfo').html(dot_onedatabuy(buy_unfinsheddata));
                }else{
                    loadunfinshed();
                }                
            })

            $('.finshed').click(function(){
                $('#orderinfo').html('');
                $('.checked').removeClass('checked');
                $(this).addClass('checked');
                if(buy_finsheddata.length > 10){
                    $('#orderinfo').html(dot_onedatabuy(buy_finsheddata));
                }else{
                    loadfinshed();
                }  
            })

            $('#orderinfo').on('click','.button_paydown',function(){
                var that = $(this);
                var treeuserid = that.parents('.buy_onedatainfo').attr('treeuserid');
                var order_oneid = that.parents('.buy_onedatainfo').attr('order_oneid');
                var name = that.parents('.buy_onedatainfo').find('.treename').html();
                window.location = "./onetreepay.php?order_oneid="+order_oneid+"&userid="+user.userid+"&treeuserid="+treeuserid+"&name="+name+"&way=1";
            })

            $('#orderinfo').on('click','.button_payfull',function(){
                var that = $(this);
                var treeuserid = that.parents('.buy_onedatainfo').attr('treeuserid');
                var order_oneid = that.parents('.buy_onedatainfo').attr('order_oneid');
                var name = that.parents('.buy_onedatainfo').find('.treename').html();
                window.location = "./onetreepay.php?order_oneid="+order_oneid+"&userid="+user.userid+"&treeuserid="+treeuserid+"&name="+name+"&way=2";
            })


            $('#orderinfo').on('click','.button_agreepay',function(){
                var order_oneid = $(this).parents('.buy_onedatainfo').attr('order_oneid');
                $.get('/wxpay/example/agree_order_onedeposite.php', {userid:user.userid,id:order_oneid}, function(result) {
                    if(result){
                        buy_unfinsheddata = [];
                        buy_finsheddata = [];
                        for (var i = 0; i < buy_alldata.length; i++) {
                            if(buy_alldata[i].id == order_oneid){
                                buy_alldata[i].order_switch =  1;
                                buy_alldata[i].deposit_switch =  2;
                                buy_alldata[i].deposit_refund_time =  result;
                            }
                            if(buy_alldata[i].state != 10){
                                buy_unfinsheddata[buy_unfinsheddata.length] = buy_alldata[i];
                            }else{
                                buy_finsheddata[buy_finsheddata.length] = buy_alldata[i];
                            }                
                        }
                        $('#orderinfo').html(dot_onedatabuy(buy_unfinsheddata));
                    }                 
                });
            })

            $('#orderinfo').on('click','.button_disagreepay',function(){
                var order_oneid = $(this).parents('.buy_onedatainfo').attr('order_oneid');
                $.get('/com/disagree_order_onedeposite.php', {userid:user.userid,id:order_oneid}, function(result) {
                    if(result){
                        buy_unfinsheddata = [];
                        buy_finsheddata = [];
                        for (var i = 0; i < buy_alldata.length; i++) {
                            if(buy_alldata[i].id == order_oneid){
                                buy_alldata[i].order_switch =  3;
                                buy_alldata[i].order_switch_time =  result;
                            }
                            if(buy_alldata[i].state != 10){
                                buy_unfinsheddata[buy_unfinsheddata.length] = buy_alldata[i];
                            }else{
                                buy_finsheddata[buy_finsheddata.length] = buy_alldata[i];
                            }                
                        }
                        $('#orderinfo').html(dot_onedatabuy(buy_unfinsheddata));
                    }                 
                });
            })

            $('#orderinfo').on('click','.button_detail',function(){
                $('.box').remove();
                var order_oneid = $(this).parents('.buy_onedatainfo').attr('order_oneid');
                for (var i = 0; i < buy_alldata.length; i++) {
                    if(buy_alldata[i].id == order_oneid){
                        $('#alert').append(makeprocess(buy_alldata[i]));           
                        $('#process').show();
                    }                
                }
            })

            $('#orderinfo').on('click','.button_receipt',function(){
                var that = $(this);
                var sure = confirm('确定要收货,苗款将转给商家！');
                if(!sure) return;
                var order_oneid = that.parents('.buy_onedatainfo').attr('order_oneid');
                $.get('/wxpay/example/order_one_payfull.php',{id: order_oneid},function(result){
                    if(result){
                        that.parents('.buy_onedatainfo').remove();
                        buy_unfinsheddata = [];
                        buy_finsheddata = [];
                        for (var i = 0; i < buy_alldata.length; i++) {
                            if(buy_alldata[i].id == order_oneid){
                                buy_alldata[i].payment_time =  result.payment_time;        
                                buy_alldata[i].payment_mount =  result.payment_mount;        
                                buy_alldata[i].state =  10;
                            }
                            if(buy_alldata[i].state < 10){
                                buy_unfinsheddata[buy_unfinsheddata.length] = buy_alldata[i];
                            }else{
                                buy_finsheddata[buy_finsheddata.length] = buy_alldata[i];
                            }                
                        }
                    }
                });
            })

            $('#orderinfo').on('click','.button_notreceipt',function(){
                var order_oneid = $(this).parents('.buy_onedatainfo').attr('order_oneid');
                $('.uploads').attr('order_oneid',order_oneid);
                $('.uploads').addClass('nr');
                $('.alertstop').fadeIn();
                $('#remark').focus();
            })

            
            $('#orderinfo').on('click','.button_applyrefund',function(){
                var order_oneid = $(this).parents('.buy_onedatainfo').attr('order_oneid');
                $('.uploads').attr('order_oneid',order_oneid);
                $('.uploads').addClass('ar');
                $('.alertstop').fadeIn();
                $('#remark').focus();
            })

            $('.resets').click(function(){
                $('#remark').val('');
                $('.alertstop').fadeOut();
            })

            $('.uploads').click(function(){
                var order_oneid = $('.uploads').attr('order_oneid');
                var remark = $('#remark').val();
                for (var i = 0; i < buy_unfinsheddata.length; i++) {
                    if(order_oneid == buy_unfinsheddata[i].id){
                        var serial_number = buy_unfinsheddata[i].serial_number;
                        var treeuserid = buy_unfinsheddata[i].treeuserid;
                        var name = buy_unfinsheddata[i].name;
                        var number = buy_unfinsheddata[i].number;                    
                    }                
                }
                $('.alertstop').hide();
                $('#remark').val('');
                if($('.uploads').hasClass('ar')){
                    $.get('/com/order_one_stop.php',{serial_number: serial_number,treeuserid:treeuserid,name:name,remark:remark,number:number},function(result){
                        if(result){
                            for (var i = 0; i < buy_unfinsheddata.length; i++) {
                                if(order_oneid == buy_unfinsheddata[i].id){
                                    buy_unfinsheddata[i].order_switch_time =  result;            
                                    buy_unfinsheddata[i].order_switch =  2;            
                                    buy_unfinsheddata[i].order_switch_remark =  remark;            
                                }                
                            }
                            $('#orderinfo').html(dot_onedatabuy(buy_unfinsheddata));
                            alert('商家同意后定金将退回您的账户！');
                        }
                    });
                    $('.uploads').removeClass('ar');     
                }else{
                    $.get('/com/order_one_freeze.php',{serial_number:serial_number,remark:remark},function(result){
                        if(result){
                            for (var i = 0; i < buy_unfinsheddata.length; i++) {
                                if(order_oneid == buy_unfinsheddata[i].id){           
                                    buy_unfinsheddata[i].order_switch =  9;            
                                    buy_unfinsheddata[i].order_switch_remark =  remark;
                                    buy_unfinsheddata[i].order_switch_time =  result;             
                                }                
                            }
                            $('#orderinfo').html(dot_onedatabuy(buy_unfinsheddata));
                            alert('平台将尽快处理！');
                        }
                    });                
                    $('.uploads').removeClass('nr');
                }
            })

            $('#orderinfo').on('click','.button_evaluate',function(){
                evaluatebutton = $(this);
                $('.evaluate_content').show();
            })

            $('.showstar').click(function(){
                var starsn = $(this).attr('state');
                $('.starover').removeClass('starover');
                starsn = parseInt(starsn);
                starnumber = 0;
                for (var i = 0; i < starsn; i++) {
                    starnumber = 1+i;
                    $('.star'+starnumber).addClass('starover');
                }
            })

            $('#evaluate_upload').click(function(){
                if(starnumber > 0){
                    var evaluate_text = $('#evaluate_text').val();
                    var treeuserid = evaluatebutton.parents('.buy_onedatainfo').attr('treeuserid');
                    var id = evaluatebutton.parents('.buy_onedatainfo').attr('order_oneid');
                    $.getJSON('/com/shop_one_evaluate.php',{evaluate:evaluate_text,treeuserid:treeuserid,userid:user.userid,starnumber:starnumber,id:id},function(result){
                        if(result){
                            $('#evaluate_text').val('');
                            starnumber = 0;
                            $('.evaluate_content').hide();
                            $('.starover').removeClass('starover');
                            evaluatebutton.remove();
                            alert('评价成功！');
                        }else{
                            alert('评价失败！');
                        }
                    })
                }else{
                    alert('请选择您的满意度！');
                }
            })

            $('#evaluate_reset').click(function(){
                $('#evaluate_text').val('');
                starnumber = 0;
                $('.evaluate_content').hide();
                $('.starover').removeClass('starover');
            })


            $('#process').click(function(){
                $('#process').hide();  
            })

            loadunfinshed();
        </script>
    </script>
    <script type="text/html" id="tpl_managersell">
        <div class="page">
            <div class="page__bd" style="height: 100%;">
                <div class="weui-tab">
                    <div class="headtitle1">
                        <div class="topbutton checked unfinshed">
                            未完成
                        </div>
                        <div class="topbutton finshed">
                            已完成
                        </div>
                    </div>
                    <div id="orderinfo">
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">

            var sell_isloadunfinshed = false;
            var sell_isendunfinshed = false;
            var sell_isloadfinshed = false;
            var sell_isendfinshed = false;
            var sell_unfinsheddata = [];
            var sell_finsheddata = [];
            var sell_alldata = [];

            var starnumber;
            var evaluatebutton;

            var timearray = ['orderstart_time','deposit_time','deposit_refund_time','fullamount_time','delivery_time','receipt_time','order_switch_time','refund_time','payment_time'];
            var timeimpact = { 
                deposit_time: "deposit", 
                deposit_refund_time: "deposit", 
                fullamount_time: "fullamount", 
                payment_time: "payment_mount", 
                refund_time: "refund_mount"
            };
            
            var timename = {
                orderstart_time: "买家下订单",
                deposit_time: "买家已付定金",
                deposit_refund_time: "收到定金",
                fullamount_time: "买家已付全款",
                delivery_time: "发货",
                receipt_time: "买家确认收货",
                payment_time: "交易完成收到资金",
                refund_time: "退还资金",
                order_switch_time: "申请退款"
            }

            function makeprocess(one){
                var str = '';
                var orderbytime = [];
                orderbytime[0] = 'orderstart_time';
                for (var i = 1; i < timearray.length; i++) {
                    if(one[timearray[i]]){
                        orderbytime[orderbytime.length] = timearray[i];
                    }
                }
                for(var i=0;i<orderbytime.length;i++){
                    for(var j=i;j<orderbytime.length;j++){
                        if(one[orderbytime[i]] <= one[orderbytime[j]]){
                            var tmp=orderbytime[i];
                            orderbytime[i]=orderbytime[j];
                            orderbytime[j]=tmp;
                        }
                    }
                }
                for (var i = 0; i < orderbytime.length; i++) {
                    if(timeimpact[orderbytime[i]]){
                        str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[orderbytime[i]]+'：'+one[timeimpact[orderbytime[i]]]/100+'元</div><div>'+one[orderbytime[i]]+'</div></div></div>'; 
                    }else{
                        str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[orderbytime[i]]+'</div><div>'+one[orderbytime[i]]+'</div></div></div>';
                    }                        
                }
                return str;
            }

            $('#orderinfo').css('height',(windowheight-55)+'px');
            function loadunfinshed(){
                if (sell_isloadunfinshed) return;
                sell_isloadunfinshed = true;
                var limit = $('#orderinfo .sell_onedatainfo').length + ',' + 10;
                $.getJSON('/com/search_order_oneunfinshedsell.php', {userid:user.userid,limit:limit}, function(json) {
                    if(json){
                        for (var i = 0; i < json.length; i++) {
                            var mark =true;
                            for (var j = 0; j < sell_unfinsheddata.length; j++) {
                                if(sell_unfinsheddata[j].id == json[i].id){
                                  mark = false;  
                                } 
                            }
                            if(mark){
                                sell_unfinsheddata[sell_unfinsheddata.length] = json[i];
                                sell_alldata[sell_alldata.length] = json[i];
                            } 
                            var news = [];
                            news[0] = json[i];
                            $('#orderinfo').append(dot_onedatasell(news));
                        }
                    }else{
                        sell_isendunfinshed = true;
                    }
                    sell_isloadunfinshed = false;
                });
            }

            function loadfinshed(){
                if (sell_isloadfinshed) return;
                sell_isloadfinshed = true;
                var limit = $('#orderinfo .sell_onedatainfo').length + ',' + 10;
                $.getJSON('/com/search_order_onefinshedsell.php', {userid:user.userid,limit:limit}, function(json) {
                    if(json){
                            
                        for (var i = 0; i < json.length; i++) {
                            var mark =true;
                            for (var j = 0; j < sell_finsheddata.length; j++) {
                                if(sell_finsheddata[j].id == json[i].id){
                                  mark = false;  
                                } 
                            }
                            if(mark){
                                sell_finsheddata[sell_finsheddata.length] = json[i];
                                sell_alldata[sell_alldata.length] = json[i];
                            } 
                            var news = [];
                            news[0] = json[i];
                            $('#orderinfo').append(dot_onedatasell(news));
                        }
                    }else{
                        sell_isendfinshed = true;
                    }
                    sell_isloadfinshed = false;
                    
                });
            }

            

            $('#orderinfo').scroll(function() {
                var that = $(this);
                if($('.checked').hasClass('unfinshed')){
                    if (sell_isendunfinshed || sell_isloadunfinshed) return;
                    var scrollHeight = that[0].scrollHeight;
                    var scrollTop = that[0].scrollTop;
                    var elementHight = that.height();
                    if(scrollTop + elementHight >= scrollHeight-150) {
                        loadunfinshed();
                    } 
                }else{
                    if (sell_isendfinshed || sell_isloadfinshed) return;
                    var scrollHeight = that[0].scrollHeight;
                    var scrollTop = that[0].scrollTop;
                    var elementHight = that.height();
                    if(scrollTop + elementHight >= scrollHeight-150) {
                        loadfinshed();
                    }
                } 
            })

            $('#orderinfo').on('click','.info',function(){
                window.location = 'http://cnzhaoshu.com';
            })

            $('.unfinshed').click(function(){
                $('#orderinfo').html('');
                $('.checked').removeClass('checked');
                $(this).addClass('checked');
                if(sell_unfinsheddata.length > 10){
                    $('#orderinfo').html(dot_onedatasell(sell_unfinsheddata));
                }else{
                    loadunfinshed();
                }                
            })

            $('.finshed').click(function(){
                $('#orderinfo').html('');
                $('.checked').removeClass('checked');
                $(this).addClass('checked');
                if(sell_finsheddata.length > 10){
                    $('#orderinfo').html(dot_onedatasell(sell_finsheddata));
                }else{
                    loadfinshed();
                }  
            })

            $('#orderinfo').on('click','.button_detail',function(){
                $('.box').remove();
                var order_oneid = $(this).parents('.sell_onedatainfo').attr('order_oneid');
                for (var i = 0; i < sell_alldata.length; i++) {
                    if(sell_alldata[i].id == order_oneid){
                        $('#alert').append(makeprocess(sell_alldata[i]));           
                        $('#process').show();
                    }                
                }
            })

            $('#orderinfo').on('click','.button_applydeposit',function(){
                var order_oneid = $(this).parents('.sell_onedatainfo').attr('order_oneid');
                $.get('/com/order_one_applydeposit.php', {id:order_oneid}, function(result) {
                    sell_unfinsheddata = [];
                    sell_finsheddata = [];
                    for (var i = 0; i < sell_alldata.length; i++) {
                        if(sell_alldata[i].id == order_oneid){
                            sell_alldata[i].order_switch =  5;
                        }
                        if(sell_alldata[i].state != 10){
                            sell_unfinsheddata[sell_unfinsheddata.length] = sell_alldata[i];
                        }else{
                            sell_finsheddata[sell_finsheddata.length] = sell_alldata[i];
                        }                
                    }
                    $('#orderinfo').html(dot_onedatasell(sell_unfinsheddata));                  
                });
            })


            $('#orderinfo').on('click','.button_retreat',function(){
                var that = $(this);
                var sure = confirm('定金将退还给买家，您确定要退款！');
                if(!sure) return;
                var order_oneid = that.parents('.sell_onedatainfo').attr('order_oneid');
                $.getJSON('/wxpay/example/deal_order_oneretreat.php', {userid:user.userid,id:order_oneid,}, function(result) {
                    if(result){
                        that.parents('.sell_onedatainfo').remove();
                        sell_unfinsheddata = [];
                        sell_finsheddata = [];
                        for (var i = 0; i < sell_alldata.length; i++) {
                            if(sell_alldata[i].id == order_oneid){
                                sell_alldata[i].refund_time =  result.refund_time;        
                                sell_alldata[i].refund_mount =  result.refund_mount;
                                sell_alldata[i].order_switch =  10;
                                sell_alldata[i].state =  10;
                                sell_alldata[i].deposit_switch =  2;
                                sell_alldata[i].refund_no =  result.refund_no;
                                sell_alldata[i].payment_time =  result.refund_time;
                            }
                            if(sell_alldata[i].state != 10){
                                sell_unfinsheddata[sell_unfinsheddata.length] = sell_alldata[i];
                            }else{
                                sell_finsheddata[sell_finsheddata.length] = sell_alldata[i];
                            }                
                        }
                        $('#orderinfo').html(dot_onedatasell(sell_unfinsheddata));
                    }                
                });
            })

            $('#orderinfo').on('click','.button_notretreat',function(){
                var sure = confirm('交由平台处理，您确定不退款！');
                if(!sure) return;
                var order_oneid = $(this).parents('.sell_onedatainfo').attr('order_oneid');
                $.get('/com/search_order_onenotretreat.php', {userid:user.userid,id:order_oneid}, function(result) {
                    if(result){
                        sell_unfinsheddata = [];
                        sell_finsheddata = [];
                        for (var i = 0; i < sell_alldata.length; i++) {
                            if(sell_alldata[i].id == order_oneid){
                                sell_alldata[i].order_switch = 9;
                            }
                            if(sell_alldata[i].state != 10){
                                sell_unfinsheddata[sell_unfinsheddata.length] = sell_alldata[i];
                            }else{
                                sell_finsheddata[sell_finsheddata.length] = sell_alldata[i];
                            }                
                        }
                        $('#orderinfo').html(dot_onedatasell(sell_unfinsheddata));
                    }                
                });
            })

            $('#orderinfo').on('click','.button_delivery',function(){
                var sure = confirm('确定发货！');
                if(!sure) return;
                var that = $(this);
                var order_oneid = that.parents('.sell_onedatainfo').attr('order_oneid');
                $.get('/com/order_onedelivery.php', {id:order_oneid}, function(result) {
                    if(result){
                        that.html('运输中');
                        that.removeClass('button_delivery').addClass('button_over');
                    }                
                });
            })

            $('#orderinfo').on('click','.button_evaluate',function(){
                evaluatebutton = $(this);
                $('.evaluate_content').show();
            })

            $('.showstar').click(function(){
                var starsn = $(this).attr('state');
                $('.starover').removeClass('starover');
                starsn = parseInt(starsn);
                starnumber = 0;
                for (var i = 0; i < starsn; i++) {
                    starnumber = 1+i;
                    $('.star'+starnumber).addClass('starover');
                }
            })

            $('#evaluate_upload').click(function(){
                if(starnumber > 0){
                    var evaluate_text = $('#evaluate_text').val();
                    var treeuserid = evaluatebutton.parents('.sell_onedatainfo').attr('userid');
                    var id = evaluatebutton.parents('.sell_onedatainfo').attr('order_oneid');
                    $.getJSON('/com/shop_one_evaluates.php',{evaluate:evaluate_text,treeuserid:treeuserid,userid:user.userid,starnumber:starnumber,id:id},function(result){
                        if(result){
                            $('#evaluate_text').val('');
                            starnumber = 0;
                            $('.evaluate_content').hide();
                            $('.starover').removeClass('starover');
                            evaluatebutton.remove();
                            alert('评价成功！');
                        }else{
                            alert('评价失败！');
                        }
                    })
                }else{
                    alert('请选择您的满意度！');
                }
            })

            $('#evaluate_reset').click(function(){
                $('#evaluate_text').val('');
                starnumber = 0;
                $('.evaluate_content').hide();
                $('.starover').removeClass('starover');
            })

            $('#process').click(function(){
                $('#process').hide();  
            })
            loadunfinshed();
        </script>
    </script>
    <script type="text/html" id="tpl_mywallet">
        <div class="page">
            <div class="page__bd" style="height: 100%;">
                <div class="mywallet">
                    <div class="money_detail">明细</div>
                    <div class="money_operation">
                        <div id="money_money"></div>
                        <div class="money_desc">余额(元)</div>
                        <div class="money_submit">充值</div>
                    </div>
                    <div class="money_bigbackground">
                        <div id="money_bigbackground"></div>
                    </div>
                    <div id="hideshow" style="display: none"></div>          
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var moneyloading = false;
            var moneyloadend = false;
            var dot_moneyinfo = doT.template($("#dot_moneyinfo").text());

            $('.money_bigbackground').css('height',windowheight+'px');

            $.getJSON('/com/search_myrecharge.php', {userid:user.userid}, function(json) {
                $('#money_money').html(json/100);
            });

            $('.money_submit').click(function(){
                window.location = "./recharge.php";
            })

            $('.money_detail').click(function(){
                $('.money_bigbackground').show();
                $('#homeindex').hide();
                $('#hideshow').show();
                var lengths = $('#money_bigbackground .money_onedata').length;
                if(!lengths) loadrecharge();
            })
            
            $('#hideshow').click(function(){
                $('.money_bigbackground').hide();
                $('#homeindex').show();
                $('#hideshow').hide();
            })

            function loadrecharge(){
                if(moneyloading) return false;
                moneyloading = true;
                var limit = $('#money_bigbackground .money_onedata').length + ',' + 20;
                $.getJSON('/com/search_rechargehistory.php',{userid:user.userid,limit:limit},function(json){
                    if(json){
                        $('#money_bigbackground').append(dot_moneyinfo(json));
                    }else{
                        moneyloadend = true;
                    }
                    moneyloading = false;
                })
            }


            $('.money_bigbackground').scroll(function () {
                if (moneyloading || moneyloadend) return;
                var scrollHeight = $(this)[0].scrollHeight;
                var scrollTop = $(this)[0].scrollTop;
                var elementHight = $(this).height();
                if(scrollTop + elementHight >= scrollHeight-150) {
                    loadrecharge();
                } 
            });
        </script>
    </script>
</body>
</html>
