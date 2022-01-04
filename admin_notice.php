<?php
include 'admin_header.php';
//お知らせ編集画面ホーム
include 'db_conn.php';
?>

<style>
  .confirm {
    background-color: #303030;
    padding: 3rem 5rem;
    border-radius: 0.3rem;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    font-weight: bold;
    color: white;
  }

  .confirm-cannel:hover {
    cursor: pointer;
  }

  .flex {
    display: flex;
  }

  .jc-sb {
    justify-content: space-between;
  }

  .mt-2 {
    margin-top: 2rem;
  }

  .flex-column {
    flex-direction: column;
  }

  .input {
    width: 30rem;
    margin: 0 auto;
  }

  .center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .input input {
    padding: 1rem 2rem;
    margin-bottom: 1rem;
    border: none;
    background-color: #272727;
    color: white;
  }

  .textarea {
    background-color: #303030;
    width: 29.7rem;
    height: 13rem;
    color: #ffffff;
  }

  .box {
    margin-top: 40px;
    margin-left: auto;
    margin-right: auto;
  }

  .position-center {
    display: flex;
    justify-content: center;
    margin: 0 auto;
    text-align: center;
  }

  .button {
    display: inline-block;
    margin-top: 10px;
  }
</style>
<div id="app" class="notice">
  <div class="notice">
    <div class="notice-items">
      <div class="notice-item" v-for="(item,index) in notice" :key="item.id">
        <div class="confirm center" v-if="toggle == true">
          <h2 class="confirm-title">本当に削除したいですか？</h2>
          <div class="flex jc-sb mt-2">
            <div class="confirm-cannel" @click="closeToggle">
              No
            </div>
            <div class="confirm-cannel" @click="deleteConfirm">
              Yes
            </div>
          </div>
        </div>
        <div class="notice__title">
          <h1>・{{item.title}}</h1>
        </div>
        <div class="notice__time">
          <h1>{{item.time}}</h1>
        </div>
        <div class="notice__content">
          <h1>{{item.content}}</h1>
        </div>
        <div>
          <button @click="edit(index)">編集</button>
          <button @click="deleteNotice(item.id),moveToTop()">削除</button>
        </div>
      </div>
    </div>

    <div class="box" v-if="toggle_input == true">
      <div class="input flex flex-column">
        <h1>・タイトル</h1>
        <input type="text" v-model="title">
        <h1>・内容</h1>
        <textarea class="textarea" type="textarea" v-model="content"></textarea>
      </div>
      <br>
      <button @click="editConfirm(),moveToTop()" class="position-center">更新</button>
      <br>
    </div>

    <input type="button" onclick="location.href='./admin_notice_new.php'" class="button position-center" value="追加">
  </div>

  <script>
    var vm = new Vue({
      el: '#app',
      data: function() {
        return {
          notice: [],
          title: "",
          content: "",
          id: "",
          delete_id: "",
          toggle: false,
          toggle_input: false,
        }
      },
      methods: {
        async moveToTop() {
          const duration = 200; // 移動速度
          const interval = 5; // 0.005秒ごとに移動
          const step = -window.scrollY / Math.ceil(duration / interval); // 1回に移動する距離
          const timer = setInterval(() => {
            window.scrollBy(0, step); // スクロール位置を移動
            if (window.scrollY <= 0) {
              clearInterval(timer);
            }
          }, interval);

        },
        async closeToggle() {
          this.toggle = false;
        },
        async deleteNotice(id) {
          this.delete_id = id;
          this.toggle = true;
        },
        async getNotice() {
          axios.post('controller/NoticeController.php', {
            action: 'getNotice',
          }).then((response) => {
            this.notice = response.data;
            console.log(response.data);
          })
        },
        async edit(index) {
          this.toggle_input = true;
          this.title = this.notice[index].title;
          this.content = this.notice[index].content;
          this.id = this.notice[index].id;
        },
        async editConfirm() {
          axios.post('controller/NoticeController.php', {
            action: 'editNotice',
            title: this.title,
            content: this.content,
            id: this.id,
          }).then((response) => {
            console.log(response.data);
            this.getNotice();
          })
        },

        async deleteConfirm() {
          axios.post('controller/NoticeController.php', {
            action: 'deleteNotice',
            id: this.delete_id,
          }).then((response) => {
            console.log("削除しました！")
            this.getNotice();
            this.toggle = false;
          });
        }
      },
      created() {
        this.getNotice();
      },
      mounted() {},
    })
  </script>