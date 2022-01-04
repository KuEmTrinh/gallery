<?php
include("header.php");
include 'db_conn.php';
?>



<div id="app" class="notice">
  <div class="notice">
    <div class="notice-name">
      <h1>お知らせ</h1>
    </div>
    <div class="notice-items">
      <div class="notice-iten" v-for="(item,index) in notice" :key="item.id">
        <div class="notice__title">
          <h1>・{{item.title}}</h1>
        </div>

        <div class="notice__time">
          <h1>{{item.time}}</h1>
        </div>

        <div class="notice__content">
          <h1> {{item.content}}</h1>
        </div>

      </div>
    </div>

  </div>

</div>

<script>
  var vm = new Vue({
    el: '#app',
    data: function() {
      return {
        notice: [],
        title: "",
        content: "",
        time: "",
        id: "",
      }
    },
    methods: {
      async getNotice() {
        axios.post('controller/NoticeController.php', {
          action: 'getNotice',
        }).then((response) => {
          this.notice = response.data;
          console.log(response.data);
        })
      }

    },

    computed: {
      // timeで並べ替え
      async sortedItemsByTime() {
        return this.items.sort((a, b) => {
          return (a.time < b.time) ? -1 : (a.time > b.time) ? 1 : 0;
        });;
      }
    },

    async edit(index) {
      this.toggle_input = true;
      this.title = this.notice[index].title;
      this.content = this.notice[index].content;
      this.id = this.notice[index].id;
    },

    sortBy(key) {
      this.sort_key = key;
    },
    created() {
      this.getNotice();
      alert($id);
    },
    mounted() {},
  })
</Script>

<?php
include 'footer.php';
?>