<?php
include("header.php");
?>

<?php

?>

<div id="app">
    <button @click="nowEvent">now</button>
    {{believe}}
    <table>
        <tr v-for="(event,index) in events" :key="event.id">
            <div v-if="believe == true">
                <td>{{event.name}}</td>
                <td>{{event.content}}</td>
                <td>{{event.time_start}}</td>
                <td>{{event.time_end}}</td>
                <td>{{event.artist}}</td>
                <td>
                    <img :src="event.photo" class="event_image">
                </td>
                <td>{{event.time}}</td>
            </div>
        </tr>
    </table>

</div>


<script>
    var vm = new Vue({
        el: '#app',
        data: function() {
            return {
                believe: false,
                events: [],
                nowevents: [],
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

            async getCurrentTime() {
                var today = new Date();
                var present_day = String(today.getDate()).padStart(2, '0');
                var present_month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var present_year = today.getFullYear();
                this.today = present_year + '-' + present_month + '-' + present_day + ' 00:00:00';

            },

            async nowEvent() {
                this.events.forEach((el) => {
                    if (el.time_start < this.today && el.time_end > this.today) {
                        this.nowevents.push(el);
                        this.believe = true;
                        this.events = this.nowevents;
                    } else {
                        this.believe = false;
                    }
                })

                
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