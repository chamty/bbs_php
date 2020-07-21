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
      notError: true,
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
        this.isActive1 = !this.isActive1;
        this.isActive2 = !this.isActive2;
        this.notError = !this.notError;
        } else if (!this.newInputName) {
          this.isActive1 = !this.isActive1;
          this.notError = !this.notError;
        } else if (!this.newInputMessage) {
          this.isActive2 = !this.isActive2;
          this.notError = !this.notError;
        }
      }
    }
  })























}