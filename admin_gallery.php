<?php
include 'admin_header.php';
//お知らせ編集画面ホーム
include 'db_conn.php';

$sql = "SELECT id, time FROM tb_photo";
$result = $conn->query($sql);
?>
<style>
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
<input type="button" onclick="location.href='./admin_gallery_create.php'" value="平面図追加">
<?php
include("gallery_item.php");
?>

<body>
  <!-- <form action="admin_gallery.php" method="post">
    <button @click="deleteGallery">削除</button>
  </form> -->
</body>

</html>
<!-- <script>
  var vm = new Vue({
    el: '#app',
    data: function() {
      return {
        gallerys: [],
      }
    },
    method: {
      async getGallerys() {
        axios.post('controller/GalleryController.php', {
          action: 'getGallerys',
        }).then((response) => {
          this.gallerys = response.data;
          console.log(response.data);
        })
      },
      async deleteGallery() {
        axios.post('controller/GalleryController.php', {
          action: 'deleteGallery',
          id: this.delete_id,
        }).then((response) => {
          console.log("削除しました！")
          this.getGallery();
          this.toggle = false;
        });
      },
    },
    created() {
      this.getGallerys();
    },
    mounted() {},
  })
</script> -->