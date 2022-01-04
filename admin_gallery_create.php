<?php
include 'admin_header.php';
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

    .gallery_info {
        margin-top: 0.5rem;
        display: flex;
        justify-content: space-between;
    }

    .gallery_delete {
        background-color: white;
        font-size: 1rem;
        border: solid 1px #373737;
        border-radius: 5px;
        margin: 3px;
    }

    .gallery_buttons {
        display: flex;
        flex-direction: column;
    }

    .gallery_desc {
        height: 10rem;
    }
</style>
<div id="app">
    <div class="gallery" v-if="gallerys.length > 0">
        <div class="gallery_item" v-for="(gallery,index) in gallerys" :key="gallery.id">
            <img :src="gallery.url" alt="">
            <div class="gallery_info">
                <div class="gallery_name">
                    <h2>{{gallery.name}}</h2>
                </div>
                <div class="gallery_buttons">
                    <button class="gallery_delete" @click.prevent="galleryDelete(gallery.id, index, gallery.url)">削除</button>
                    <button class="gallery_delete" @click.prevent="galleryGetEl(gallery.id, gallery.name)">編集</button>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery_create" v-if="edit == true">
        <div class="gallery_form">
            <input type="text" name="gallery_name" v-model="name">
            <button class="gallery_upload" @click.prevent="galleryEdit">編集</button>
        </div>
    </div>
    <div class="gallery_create">
        <form action="admin_gallery_upload.php" method="post" enctype="multipart/form-data" class="gallery_form">
            <input type="file" name="uploadFile">
            <input type="text" name="photo_name">
            <!-- <button @click.prevent="getTime">CHECK</button> -->
            <div class="gallery_submit">
                <input type="submit" name="submit" value="Upload" class="gallery_upload">
            </div>
        </form>
    </div>
</div>

<script>
    var vm = new Vue({
        el: '#app',
        data: function() {
            return {
                gallerys: '',
                edit: false,
                name: '',
                id: ''
            }
        },
        methods: {
            getGallerys() {
                axios.post('controller/GalleryController.php', {
                    action: 'getGallerys'
                }).then(response => (this.gallerys = response.data))
            },
            galleryDelete(id, index, url) {
                this.gallerys.splice(index, 1);
                axios.post('controller/GalleryController.php', {
                    action: 'galleryDelete',
                    id: id,
                    url: url,
                }).then(console.log("けしました！"));
            },
            galleryGetEl(id, name) {
                this.edit = true;
                this.id = id;
                this.name = name;
            },
            galleryEdit() {
                axios.post('controller/GalleryController.php', {
                    action: 'galleryEdit',
                    id: this.id,
                    name: this.name,
                }).then(response => (this.getGallerys()));
                this.edit = false;
            },
            // getTime() {
            //     var dateControl = document.querySelector('input[type="datetime-local"]');
            //     console.log(dateControl.value);
            // }
        },
        created: function() {
            this.getGallerys();
        },
        mounted() {},
    })
</script>