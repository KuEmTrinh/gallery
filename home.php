<?php
include("header.php");

?>

<style>
    .home-notice {
        margin-top: 3em;
        padding-left: 20%;
        padding-right: 20%;
    }

    .title {
        font-size: 2rem;
        font-weight: bold;
        position: relative;
    }

    .home-notice__items {
        text-align: left;
        margin-top: 3px;
    }

    .home-notice__title {
        display: inline-block;
        margin-top: 15px;
        margin-left: 15px;
        margin-right: 15px;
        font-size: 1.5rem;
    }

    .home-notice__time {
        margin-top: 8px;
        margin-bottom: 15px;
        margin-left: 15px;
        display: inline-block;
    }

    .home-notice__content {
        color: #5c5c5c;
        text-indent:1em;
        line-height: 20px;
        padding-left:3em;
        margin-bottom: 2em;
    }
</style>
<main>
    <div class="content">
        <div class="event">
            <div class="event-text">
                <h2 class="event-text__title">KOKODESIKA</h2>
                <p class="event-text__desc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
                    necessitatibus sint, ex mollitia quis doloribus neque voluptatem,
                    excepturi atque quod sed delectus beatae repudiandae ut. Obcaecati
                    recusandae non accusantium doloremque!
                </p>
            </div>
            <div class="event-image">
                <img src="images/art.jpg" alt="">
            </div>
        </div>


        <div id="app" class="home-notices">
            <div class="home-notice">
                <div>
                    <h2 class="title">お知らせ</h2>
                </div>
                <div class="home-notice__items">
                    <div class="home-notice__iten" v-for="(item,index) in notice" :key="item.id">
                        <div class="home-notice__title">
                            <h1>・{{item.title}}</h1>
                        </div>

                        <div class="home-notice__time">
                            <h1>{{item.time}}</h1>
                        </div>

                        <div class="home-notice__content">
                            <h1>{{item.content}}</h1>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

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
                    action: 'getNoticeThree',
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

        // computed: {
        //     limitCount() {
        //         return this.items.slice(0, 4)
        //     }
        // },

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
include("footer.php");
?>