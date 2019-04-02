<template>
  <div style="position: fixed;top: 0;">
    <input type="file" @change="subImg">
  </div>
</template>

<script>
import {imgPreview} from '../../libs/imgPreview'
import {postSuperviseImg} from "../../api/supervise"
export default {
  data() {
    return {

    };
  },
  created:{

  },
  methods: {
      subImg(e) {
          imgPreview(e.target.files[0]).then(file => {
              console.log(file)
              var formData = new FormData();
              formData.append('photo', file);
              postSuperviseImg(formData).then(res => {
                  console.log(res)

              })
          }).catch(file => {
              console.log(file)
              var formData = new FormData();
              formData.append('photo', file);
              postSuperviseImg(formData).then(res => {
                  console.log(res)
              })
          })
      }
  }
};
</script>

<style lang="less">

</style>
