<?php
include 'admin_header.php';
//お知らせ編集画面ホーム
include 'db_conn.php';

$sql = "SELECT id, title, content, time FROM tb_notice";
$result = $conn->query($sql);
?>
<a href="admin_event_create.php">イベントを追加する</a>
<hr>
<style>
  .event_image {
    width: 3rem;
    height: 3rem;


    border-radius: 3rem;
    object-fit: cover;
  }

  .box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    border-radius: 1rem;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    width: 15rem;
    height: 10rem;
    align-items: center;
  }

  .flex {
    display: flex;
  }

  .wrap {
    margin: 0 auto;
    width: 100%;
  }

  .wrap h1 {
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .box-btn {
    justify-content: space-evenly;
  }

  .box-btn h2 {
    padding: 0.5rem 1rem;
    background-color: #303030;
    color: #fff;
    border-radius: 0.4rem;
    font-weight: bold;
    font-size: 1rem;
  }

  .edit-box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 3rem;
    background-color: #fff;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  }

  .edit-box h3 {
    font-weight: bold;
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  .edit-box input {
    border: 1px solid #373737;
    padding: 1rem;
  }
</style>
<div id="app">
  <!-- Delete Box -->
  <div class="box flex" v-if="deleteSwitch == true">
    <div class="wrap">
      <h1>本当に削除したいですか？</h1>
      <div class="box-btn flex">
        <h2 @click="deleteClose">キャンセル</h2>
        <h2 @click="deleteConfirm">削除</h2>
      </div>
    </div>
  </div>
  <!-- Edit Box  -->
  <div class="edit-box" v-if="editSwitch == true">
    <h3>名前</h3>
    <input type="text" v-model="event.name">
    <h3>Content</h3>
    <input type="text" v-model="event.content">
    <h3>開始時間</h3>
    <p>{{event.time_start}}</p>
    <input type="date" v-model="event.time_start">
    <h3>終了時間</h3>
    <p>{{event.time_end}}</p>
    <input type="date" v-model="event.time_end">
    <h3>Artits</h3>
    <input type="text" v-model="event.artist">
    <div class="box-btn flex">
      <h2 @click="editClose">キャンセル</h2>
      <h2 @click="editConfirm">完了</h2>
    </div>
  </div>


  <button @click.prevent="filterEvent">Filter</button>
  <table width="100%">
    <tr v-for="(event,index) in events" :key="event.id">
    <tr v-for="event in events" :key="event.id">
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
      <td>{{event.name}}</td>
      <td>{{event.content}}</td>
      <td>{{event.time_start}}</td>
      <td>{{event.time_end}}</td>
      <td>{{event.artist}}</td>
      <td>
        <img :src="event.photo" class="event_image">
      </td>
      <td>{{event.time}}</td>
      <td><button @click="editEvent(index)">編集</button>

      </td>
      <td><button @click="deleteEvent(event.id)">削除</button>
      </td>
      <form action="admin_event_create.php" method="post">
        <td><button type="submit" name="add">編集</button> </td>
        <td><button type="submit" name="remove">削除</button></td>
      </form>
    </tr>

    <button @click.prevent="shortEventByTime">一番最新</button>
  </table>
</div>
<html lang="pa">


</html>
<?php require "footer.php"; ?>

<script>
  var vm = new Vue({
    el: '#app',
    data: function() {
      return {
        events: [],
        new_events: [],
        event: "",
        today: "",
        name: "",
        content: "",
        id: "",
        delete_id: "",
        time_start: "",
        time_end: "",
        artist: "",
        photo: "",
        time: "",
        deleteSwitch: false,
        editSwitch: false,
      }
    },
    methods: {
      async getEvent() {
        axios.post('controller/EventController.php', {
          action: 'getEvents',
        }).then((response) => {
          this.events = response.data;
        })
      },
      async shortEventByTime() {
        this.events.sort((a, b) => {
          return (new Date(b.time_start) - new Date(a.time_start));
        })
      },

      async getCurrentTime() {
        var today = new Date();
        var present_day = String(today.getDate()).padStart(2, '0');
        var present_month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var present_year = today.getFullYear();
        this.today = present_year + '-' + present_month + '-' + present_day + ' 00:00:00';
      },

      async filterEvent() {
        this.events.forEach((el) => {
          if (el.time_start < this.today && el.time_end > this.today) {
            this.new_events.push(el);
          }
        })

        this.events = this.new_events;
      },
      async deleteEvent(id) {
        this.id = id;
        this.deleteSwitch = true;
      },

      async deleteClose() {
        this.deleteSwitch = false;
      },
      async editClose() {
        this.editSwitch = false;
      },

      async deleteConfirm() {
        axios.post('controller/EventController.php', {
          action: 'deleteEvent',
          id: this.id,
        }).then((response) => {
          console.log("削除しました！")
          this.getEvent();
          this.deleteSwitch = false;
        });
      },
      async editEvent(index) {
        this.event = this.events[index];
        this.editSwitch = true;
      },
      async editConfirm() {
        axios.post('controller/EventController.php', {
          action: 'editEvent',
          id: this.event.id,
          name: this.event.name,
          content: this.event.content,
          time_start: this.event.time_start,
          time_end: this.event.time_end,
          artist: this.event.artist,
        }).then((response) => {
          this.editSwitch = false;
          this.getEvent();
        })
      }
    },

    created() {
      this.getEvent();
      this.getCurrentTime();
    },
    mounted() {}
  })
</script>

<!-- イベント削除したい時 -->

<!-- ステップ１ -->
<!-- 削除したいイベントのIDを取り出すことです -->

<!-- ステップ２
ボックスを作成して、スイッチみたいの変数を作って -->