<style>
</style>
<template>
  <div style="width: 100%;height: 100%;">
    <iframe style="width: 100%;height: 100%;" :src="excelUrl"frameborder="0"></iframe>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        excelUrl:"http://cnzhaoshu.com/admin/excel-form.html"
      }
    },
    methods: {

    },
    mounted () {
      this.excelUrl = window.location.origin+"/admin/excel-form.html"

    },
    beforeDestroy () {

    }
  }
</script>
