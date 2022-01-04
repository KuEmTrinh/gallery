<style>
    .flex {
        display: flex;
    }

    .gallery {
        flex-wrap: wrap;
    }

    .gallery-item {
        margin: 1rem;
        width: calc(20% - 2rem);
    }

    .gallery-item__image {
        position: relative;
        -ms-flex-negative: 0;
        /* flex-shrink: 0; */
        width: 100%;
        padding-top: 100%;
        margin-bottom: 2rem;
        border-radius: 2rem;
        overflow: hidden;
        -webkit-box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
        box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
    }

    .gallery-item__image img {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .gallery-item h1 {
        text-align: center;
        font-weight: bold;
        margin-top: 1rem;
        font-size: 1.6rem;
    }

    .jc-sb {
        justify-content: space-between;
    }
</style>
<div id="app">
    <div class="gallery flex jc-sb">
        <div class="gallery-item" v-for="gallery in gallerys" :key="gallery.id">
            <div class="gallery-item__image">
                <img :src="gallery.url" alt="">
            </div>
            <h1>{{gallery.name}}</h1>
        </div>
    </div>
</div>

<script>
    var vm = new Vue({
        el: '#app',
        data: function() {
            return {
                gallerys: [],
            }
        },
        methods: {
            async getGallery() {
                axios.post('controller/GalleryController.php', {
                    action: 'getGallerys',
                }).then((response) => {
                    this.gallerys = response.data;
                    console.log(response.data);
                })
            },
        },
        created() {
            this.getGallery();
        },
        mounted() {},
    })
</script>