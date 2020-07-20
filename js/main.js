'use strict' 
{
  const vm = new Vue({
    el: '#app',
    data: {
      newInputName: '',
      newInputMessage: '',
      tweets: [],
    },
    methods: {
      addTweet() {
        if (!this.newInputName || !this.newItemMessage) {
          return;
        }
        this.tweets.push({
          name: this.newInputName,
          time: this.newInputTime,
          message: this.newInputMessage,
        });
        this.newInputMessage = '';
      },
    }
  })























}