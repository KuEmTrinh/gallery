<?php
include("header.php");
?>
<style>
    .gallery {
        display: flex;
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .gallery_item {
        width: 33%;
        margin-top: 2rem;
    }

    .gallery_item img {
        width: 100%;
        height: 70%;
        object-fit: cover;
        border-radius: 1rem;
    }

    .gallery_name {
        padding: 1rem;
        text-align: center;
    }

    .gallery_delete {
        background-color: white;
        font-size: 1rem;
        border: solid 1px #373737;
        border-radius: 5px;
    }
</style>
<div id="app">
    <div class="buttons">
        <button @click.present="getPastGallery">開催予定イベント</button>
        <button @click.present="getPresentGallery">現在開催中</button>
        <button @click.present="getFutureGallery">過去イベント</button>
    </div>
    <div class="gallery">
        <div class="gallery_item" v-for="(gallery,index) in gallerys" :key="gallery.id">
            <img :src="gallery.url" alt="">
            <h2 class="gallery_name">{{gallery.name}}</h2>
            <h2 class="gallery_name">{{gallery.start_time}}</h2>
            <h2 class="gallery_name">{{gallery.end_time}}</h2>
            <!-- <h2 class="gallery_name">{{gallery.description}}</h2> -->
        </div>
    </div>
</div>

<script>
    var vm = new Vue({
        el: '#app',
        data: function() {
            return {
                gallerys: [],
                past: [],
                present: [],
                future: [],
            }
        },
        methods: {
            getGallerys() {
                axios.post('controller/GalleryController.php', {
                    action: 'getGallerys'
                }).then(response => {
                    this.gallerys = response.data;
                    for (let i = 0; i < this.gallerys.length; i++) {
                        //TODAY
                        var today = new Date();
                        var present_day = String(today.getDate()).padStart(2, '0');
                        var present_month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var present_year = today.getFullYear();
                        today = present_year + '-' + present_month + '-' + present_day;

                        //START DAY
                        var start_day = this.gallerys[i].start_time;

                        //END DAY
                        var end_day = this.gallerys[i].end_time;

                        //CHECK
                        //開催予定イベント
                        if (end_day < today) {
                            this.past.push(this.gallerys[i]);
                        }
                        //現在開催中
                        if (start_day > today) {
                            this.future.push(this.gallerys[i])
                        }
                        //過去イベント
                        if ((start_day < today) && (end_day > today)) {
                            this.present.push(this.gallerys[i])
                        }
                    }
                });
            },
            getPastGallery() {
                console.log('past');
                this.gallerys = this.past;
            },
            getPresentGallery() {
                this.gallerys = this.present;
            },
            getFutureGallery() {
                this.gallerys = this.future;
            },
        },
        created: function() {
            this.getGallerys();
        },
        mounted() {},
    })
</script>