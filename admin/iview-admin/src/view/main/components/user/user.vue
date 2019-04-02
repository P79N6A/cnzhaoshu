<template>
  <div class="user-avator-dropdown">
    <Dropdown @on-click="handleClick">
      <Avatar :src="userAvator"/>
      <Icon :size="18" type="md-arrow-dropdown"></Icon>
      <DropdownMenu slot="list">
        <DropdownItem name="logout">退出登录</DropdownItem>
      </DropdownMenu>
    </Dropdown>
  </div>
</template>

<script>
  import './user.less'
  import Cookies from 'js-cookie'

  export default {
    name: 'User',
    props: {
      userAvator: {
        type: String,
        default: ''
      }
    },
    methods: {
      handleClick (name) {
        this.delcookie('user2')
        window.location.href = 'http://cnzhaoshu.com/login.html?login_uri=/admin/iview-admin/dist/index.html'
      },
      delcookie (name) {
        var date = new Date()
        date.setTime(date.getTime() - 10000)
        document.cookie = name + '=a;expires=' + date.toGMTString() + ';path=/;domain=cnzhaoshu.com'
      }
    }
  }
</script>
