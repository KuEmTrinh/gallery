<?php
include("header.php");
?>
<style>
    .flex {
        display: flex;
    }

    .wrap {
        margin: 0 auto;
        width: 100%;
    }

    .event {
        flex-wrap: wrap;
    }

    .event-item,
    .event__modal {
        box-sizing: border-box;
        padding: 2rem;
        background-color: #F0F0F0;
        border-radius: 19px;
        margin: 1rem;
        width: 20%;
    }

    .event__modal {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #eee;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        width: 35rem;
    }

    .jc-sb {
        justify-content: space-between;
    }

    .black {
        color: #464646;
    }

    .grey {
        color: #777777;
    }

    .event-item__title h1 {
        word-break: break-all;
        font-size: 24px;
        font-weight: bold;
    }

    .mbt-15 {
        margin-bottom: 1.5rem;
    }

    .mbt-1 {
        margin-bottom: 1rem;
    }

    .event-item__time {
        font-weight: bold;
    }

    .event-item__image img {
        width: 100%;
        height: auto;
    }

    .event-item__content {
        font-size: 0.9rem;
    }

    .event-modal__icon i {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(50%, -50%);
        background-color: #464646;
        color: white;
        padding: 0.6rem;
        border-radius: 50%;
    }

    .event-item__title i {
        font-size: 1.5rem;
        color: #464646;
    }

    .event-item__title i:hover,
    .event-modal__icon i:hover {
        transition: 0.2s all linear;
        font-size: 2rem;
    }
</style>
<div id="app">
    <!-- Event Content Details -->
    <div class="event__modal" v-if="eventSwitch == true">
        <div class="event-modal__icon" @click="hideEvent">
            <i class="fas fa-times"></i>
        </div>
        <div class="event-item__title flex jc-sb black mbt-1">
            <h1>{{event.name}}</h1>
        </div>
        <div class="event-item__time grey mbt-1">
            <h1 class="mbt-1">開催時間</h1>
            <h1>{{event.time_start}} ~ {{event.time_end}}</h1>
        </div>
        <div class="event-item__content grey mbt-1">
            <h1 class="mbt-1">内容</h1>
            <h2>{{event.content}}</h2>
        </div>
        <div class="event-item__image">
            <img :src="event.photo" alt="">
        </div>
    </div>
    <!-- Event list -->
    <div class="event flex">
        <div class="event-item" v-for="(item,index) in events" :key="item.id">
            <div class="event-item__title flex jc-sb black mbt-1">
                <h1>{{item.name}}</h1>
                <i class="fas fa-info-circle" @click="showEvent(index)"></i>
                <i class="fas fa-sitemap" v-if="contentSwitch == true">
                    <div class="wrap">
                        <h1>{{item.content}}</h1>
                        <div class="fas fa-sitemap flex">
                            <h2 @click="contentClose">キャンセル</h2>
                        </div>
                    </div>
                </i>
            </div>
            <div class="event-item__time grey mbt-1">
                <h1 class="mbt-1">開催時間</h1>
                <h1>{{item.time_start}} ~ {{item.time_end}}</h1>
            </div>
            <div class="event-item__image">
                <img :src="item.photo" alt="">
            </div>
        </div>
    </div>
</div>
<script>
    var vm = new Vue({
        el: '#app',
        data: function() {
            return {
                events: [],
                event: "",
                today: "",
                eventSwitch: false,
                contentSwitch: false,
                content: "",
            }
        },
        methods: {
            async getEvent() {
                axios.post('controller/EventController.php', {
                    action: 'getEvents',
                }).then((response) => {
                    this.events = response.data;
                    console.log(response.data);
                    this.filterEvent();
                })
            },
            async filterEvent() {
                const new_events = [];
                this.events.forEach((el) => {
                    if (el.time_start < this.today && el.time_end > this.today) {
                        new_events.push(el);
                    }
                })
                this.events = new_events;
            },
            async hideEvent() {
                this.eventSwitch = false;
            },
            async getCurrentTime() {
                var today = new Date();
                var present_day = String(today.getDate()).padStart(2, '0');
                var present_month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var present_year = today.getFullYear();
                this.today = present_year + '-' + present_month + '-' + present_day + ' 00:00:00';
            },
            async showEvent(index) {
                this.event = this.events[index];
                this.eventSwitch = true;
            },
            async contentClose() {
                this.contentSwitch = false;
            },
        },

        created() {
            this.getEvent();
            this.getCurrentTime();
        },
        mounted() {}
    })
</script>

<?php require "footer.php"; ?>