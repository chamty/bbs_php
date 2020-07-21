'use strict' 
{
  const vm = new Vue({
    el: '#app',
    data: {
      newInputName: '',
      newInputTime: '',
      newInputMessage: '',
      isActive1: false,
      isActive2: false,
      notError1: true,
      notError2: true,
      tweets: [],
    },
    methods: {
      addTweet() {
        if (!this.newInputName || !this.newInputMessage) {
          return;
        }
        this.tweets.unshift({
          name: this.newInputName,
          time: this.newInputTime,
          message: this.newInputMessage,
        });
        this.newInputMessage = '';
      },
      nowDate() {
        const date = new Date();
        const year = date.getFullYear();
        const month = date.getMonth() + 1;
        const day = date.getDate();
        const hour = date.getHours();
        const minute = date.getMinutes();

        this.newInputTime = year + '年' + month + '月' + day + '日' + hour + ':' + minute;
      },
      redMessage() {
        if (!this.newInputName && !this.newInputMessage) {
        this.isActive1 = true;
        this.isActive2 = true;
        this.notError1 = false;
        this.notError2 = false;
        } else if (!this.newInputName) {
          this.isActive1 = true;
          this.notError1 = false;
          if (this.newInputName) {
            this.isActive1 = false;
            this.notError1 =true;
          }
        } else if (!this.newInputMessage) {
          this.isActive2 = true;
          this.notError2 = false;
        }

        if (this.newInputName) {
          this.isActive1 = false;
          this.notError1 =true;
        }

        if (this.newInputMessage) {
          this.isActive2 = false;
          this.notError2 =true;
        }
      }
    }
  })























}