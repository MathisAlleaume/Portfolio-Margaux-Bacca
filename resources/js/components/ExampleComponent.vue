<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" id="categories">
          <div class="card-header">Catégorie :</div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setCategorie('Video')"
                  >Vidéo</b-button
                >
              </div>
              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setCategorie('Photo')"
                  >Photo</b-button
                >
              </div>

              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setCategorie('Collections')"
                  >Collections</b-button
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" v-if="categorie == 'Photo'">
          <div class="card-header">Photo</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="success"
                  v-on:click="setAction('add')"
                  >Ajouter</b-button
                >
              </div>

              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setAction('edit')"
                  >Modifier</b-button
                >
              </div>
              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="danger"
                  v-on:click="setAction('del')"
                  >Supprimer</b-button
                >
              </div>
            </div>
            <hr v-if="action == 'add'" />
            <hr v-if="action == 'edit'" />
            <hr v-if="action == 'del'" />
            <div v-if="action == 'add'">
              <div class="row">
                <div class="col-md-1">
                  <label for="collectionSelect">Collection:</label>
                </div>
                <div class="col-md-11">
                  <b-form-select
                    v-model="photos.collectionID"
                    :options="collectionSelOptions"
                    @change="getCollection()"
                    id="collectionSelect"
                    name="collectionSelect"
                  ></b-form-select>
                </div>
              </div>
              <hr />
              <div class="row" v-if="action == 'add'">
                <div class="col-md-12">
                  <b-form-file
                    v-model="photos.imgs"
                    :state="Boolean(photos.imgs)"
                    multiple
                    placeholder="Choose a photo or drop it here..."
                    drop-placeholder="Drop file here..."
                  ></b-form-file>
                </div>
              </div>
              <br />
              <div class="row">
                <div
                  class="col-md-4"
                  v-for="(url, index) in photos.imgs"
                  style="margin-bottom: 30px"
                >
                  <b-img v-bind:src="url" fluid alt="image preview"></b-img>
                  <br />
                </div>
              </div>
              <br />
              <div class="row" v-if="action == 'add'">
                <div class="col-md-4"></div>
                <div class="col-md-2">
                  <b-button v-on:click="imgsUploaded()">Preview</b-button>
                </div>
                <div class="col-md-2">
                  <b-button variant="success" v-on:click="imageStore()"
                    >Enregistrer</b-button
                  >
                </div>
                <div class="col-md-4"></div>
              </div>
            </div>
            <div v-if="action == 'edit'">
              <div class="row">
                <div class="col-md-1">
                  <label for="videoSelect">Vidéo :</label>
                </div>
                <div class="col-md-11">
                  <b-form-select
                    v-model="selectedVideo"
                    :options="videoSelOptions"
                    name="videoSelect"
                    id="videoSelect"
                    @change="getVideo()"
                  ></b-form-select>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <hr />
                </div>
                <div class="col-md-1"></div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-1">
                  <label for="videoTitleInput">Titre :</label>
                </div>
                <div class="col-md-11">
                  <b-form-input
                    type="text"
                    name="videoTitleInput"
                    id="videoTitleInput"
                    v-model="video.Titre"
                  ></b-form-input>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-1">
                  <label for="videoLinkInput">Lien :</label>
                </div>
                <div class="col-md-10">
                  <b-form-input
                    type="text"
                    name="videoLinkInput"
                    id="videoLinkInput"
                    v-model="video.lien"
                  ></b-form-input>
                </div>
                <div class="col-md-1" style="padding-left: 0px">
                  <b-button v-on:click="videoPreview()">preview</b-button>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <youtube
                    :video-id="ytbID"
                    ref="youtube"
                    v-if="onPreview == true"
                  ></youtube>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                  <b-button variant="success" v-on:click="videoEdit()"
                    >Modifier</b-button
                  >
                </div>
                <div class="col-md-5"></div>
              </div>
            </div>
            <div v-if="action == 'del'">
              <div class="row">
                <div class="col-md-1">
                  <label for="videoSelect">Vidéo :</label>
                </div>
                <div class="col-md-11">
                  <b-form-select
                    v-model="selectedVideo"
                    :options="videoSelOptions"
                    name="videoSelect"
                    id="videoSelect"
                    @change="getVideo()"
                  ></b-form-select>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <b-button
                    class="catButton"
                    variant="danger"
                    v-on:click="delVideo()"
                    >Supprimer</b-button
                  >
                </div>
                <div class="col-md-2"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="card" v-if="categorie == 'Video'">
          <div class="card-header">Vidéos</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="success"
                  v-on:click="setAction('add')"
                  >Ajouter</b-button
                >
              </div>

              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setAction('edit')"
                  >Modifier</b-button
                >
              </div>
              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="danger"
                  v-on:click="setAction('del')"
                  >Supprimer</b-button
                >
              </div>
            </div>
            <hr v-if="action == 'add'" />
            <hr v-if="action == 'edit'" />
            <hr v-if="action == 'del'" />
            <div v-if="action == 'add'">
              <div class="row" v-if="action == 'add'">
                <div class="col-md-1">
                  <label for="videoTitleInput">Titre :</label>
                </div>
                <div class="col-md-11">
                  <b-form-input
                    type="text"
                    name="videoTitleInput"
                    id="videoTitleInput"
                    v-model="video.Titre"
                  ></b-form-input>
                </div>
              </div>
              <br />
              <div class="row" v-if="action == 'add'">
                <div class="col-md-1">
                  <label for="videoLinkInput">Lien :</label>
                </div>
                <div class="col-md-9">
                  <b-form-input
                    type="text"
                    name="videoLinkInput"
                    id="videoLinkInput"
                    v-model="video.lien"
                  ></b-form-input>
                </div>
                <div class="col-md-1">
                  <b-button v-on:click="videoPreview()">preview</b-button>
                </div>
              </div>
              <br />
              <div class="row" v-if="action == 'add'">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <youtube
                    :video-id="ytbID"
                    ref="youtube"
                    v-if="onPreview == true"
                  ></youtube>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="row" v-if="action == 'add'">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                  <b-button variant="success" v-on:click="videoCreate()"
                    >Enregistrer</b-button
                  >
                </div>
                <div class="col-md-5"></div>
              </div>
            </div>
            <div v-if="action == 'edit'">
              <div class="row">
                <div class="col-md-1">
                  <label for="videoSelect">Vidéo :</label>
                </div>
                <div class="col-md-11">
                  <b-form-select
                    v-model="selectedVideo"
                    :options="videoSelOptions"
                    name="videoSelect"
                    id="videoSelect"
                    @change="getVideo()"
                  ></b-form-select>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <hr />
                </div>
                <div class="col-md-1"></div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-1">
                  <label for="videoTitleInput">Titre :</label>
                </div>
                <div class="col-md-11">
                  <b-form-input
                    type="text"
                    name="videoTitleInput"
                    id="videoTitleInput"
                    v-model="video.Titre"
                  ></b-form-input>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-1">
                  <label for="videoLinkInput">Lien :</label>
                </div>
                <div class="col-md-10">
                  <b-form-input
                    type="text"
                    name="videoLinkInput"
                    id="videoLinkInput"
                    v-model="video.lien"
                  ></b-form-input>
                </div>
                <div class="col-md-1" style="padding-left: 0px">
                  <b-button v-on:click="videoPreview()">preview</b-button>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <youtube
                    :video-id="ytbID"
                    ref="youtube"
                    v-if="onPreview == true"
                  ></youtube>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                  <b-button variant="success" v-on:click="videoEdit()"
                    >Modifier</b-button
                  >
                </div>
                <div class="col-md-5"></div>
              </div>
            </div>
            <div v-if="action == 'del'">
              <div class="row">
                <div class="col-md-1">
                  <label for="videoSelect">Vidéo :</label>
                </div>
                <div class="col-md-11">
                  <b-form-select
                    v-model="selectedVideo"
                    :options="videoSelOptions"
                    name="videoSelect"
                    id="videoSelect"
                    @change="getVideo()"
                  ></b-form-select>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <b-button
                    class="catButton"
                    variant="danger"
                    v-on:click="delVideo()"
                    >Supprimer</b-button
                  >
                </div>
                <div class="col-md-2"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="card" v-if="categorie == 'Collections'">
          <div class="card-header">Collections</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="success"
                  v-on:click="setAction('add')"
                  >Ajouter</b-button
                >
              </div>

              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setAction('edit')"
                  >Modifier</b-button
                >
              </div>
              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="danger"
                  v-on:click="setAction('del')"
                  >Supprimer</b-button
                >
              </div>
            </div>
            <hr />
            <div class="row" v-if="action == 'del' || action == 'edit'">
              <div class="col-md-1">
                <label for="collectionSelect">Collection:</label>
              </div>
              <div class="col-md-11">
                <b-form-select
                  v-model="selectedCollection"
                  :options="collectionSelOptions"
                  @change="getCollection()"
                  id="collectionSelect"
                  name="collectionSelect"
                ></b-form-select>
              </div>
            </div>

            <hr v-if="action == 'edit' || action == 'del'" />
            <br />
            <div class="row" v-if="action == 'add' || action == 'edit'">
              <div class="col-md-1">
                <label for="collectionTitreInput">Titre :</label>
              </div>
              <div class="col-md-11">
                <b-form-input
                  type="text"
                  name="collectionTitreInput"
                  id="collectionTitreInput"
                  v-model="collection.Titre"
                ></b-form-input>
              </div>
            </div>
            <br />
            <div class="row" v-if="action == 'add' || action == 'edit'">
              <div class="col-md-1">
                <label for="collectionTypeSelect">Type :</label>
              </div>
              <div class="col-md-11">
                <b-form-select
                  v-model="collection.Type"
                  :options="collectionTypeSelOptions"
                  id="collectionTypeSelect"
                  name="collectionTypeSelect"
                ></b-form-select>
              </div>
            </div>
            <br />
            <div class="row" v-if="action == 'edit'">
              <div class="col-md-1">
                <label for="collectionCoverSelect">Cover :</label>
              </div>
              <div class="col-md-9">
                <b-form-select
                  v-model="collection.Cover"
                  :options="collectionCoverSelOptions"
                  id="collectionCoverSelect"
                  name="collectionCoverSelect"
                  :disabled="collectionCoverSelectDisabled"
                >
                </b-form-select>
              </div>
              <div class="col-md-1">
                <b-button v-on:click="collectionCoverPreview()"
                  >preview</b-button
                >
              </div>
            </div>
            <br />
            <div class="row" v-if="action == 'add'">
              <div class="col-md-2"></div>
              <div class="col-md-8"></div>
              <div class="col-md-2"></div>
            </div>
            <div class="row">
              <div class="col-md-5"></div>
              <div class="col-md-2">
                <b-button
                  variant="success"
                  v-on:click="collectionCreate()"
                  v-if="action == 'add'"
                  >Enregistrer</b-button
                >
                <b-button
                  variant="success"
                  v-on:click="collectionEdit()"
                  v-if="action == 'edit'"
                  >Modifer</b-button
                >
                <b-button
                  variant="danger"
                  v-on:click="collectionDel()"
                  v-if="action == 'del'"
                  >Supprimer</b-button
                >
              </div>
              <div class="col-md-5"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      categorie: "",
      action: "",
      photos: {
        imgs: [],
        collectionID: null,
        files: null,
      },
      video: {
        Titre: "",
        lien: "",
      },
      collection: {
        Titre: "",
        Cover: 1,
        Type: null,
        Imgs: [],
      },
      collectionTypeSelOptions: [
        { value: 1, text: "Photo" },
        { value: 2, text: "Dessin" },
      ],
      dessin: {
        Titre: "",
        img: "",
        collectionID: null,
      },
      photoList: [],
      videoList: [],
      collectionList: [],
      selectedVideo: null,
      selectedPhoto: null,
      selectedCollection: null,
      collectionSelOptions: [],
      collectionCoverSelOptions: [],
      colectionImgs: [],
      videoSelOptions: [],
      photoCollectionSelOptions: [],
      photosPreviewed: false,
      collectionCoverSelectDisabled: false,
      ytbID: null,
      onPreview: false,
    };
  },
  mounted() {
    var that = this;
    // get list collection
    this.getCollectionList();

    // get list photo
    // this.getPhotoList();

    // get list dessin
    // this.getDrawingList();

    // get list vidéos
    this.getVideoList();
  },
  methods: {
    setCategorie(cat) {
      this.categorie = cat;
      this.action = "";
    },

    setAction(action) {
      this.action = action;
    },

    // gestion de collection
    getCollectionList() {
      this.collectionList = [];
      this.collectionSelOptions = [];
      var that = this;
      axios.get("/collectionList").then(function (res) {
        res.data.forEach(function (element) {
          that.collectionList.push(element);
          that.collectionSelOptions.push({
            value: element.Id,
            text: element.Titre,
          });
        });
      });
    },

    collectionCreate() {
      if (this.collection.Titre != "" && this.collection.Type != "") {
        axios.post("/collectionCreate", this.collection).then(function (res) {
          console.log(res.data);
        });
        this.getCollectionList();
        // this.videoList.push(this.video);
      }
    },
    collectionEdit: function () {
      var that = this;
      axios
        .post("/collectionEdit", {
          Id: this.selectedCollection,
          Titre: this.collection.Titre,
          Cover: this.collection.Cover,
          Lien: this.collection.Type,
        })
        .then(function (res) {
          console.log(res.data);
          that.action = "";
          that.getCollectionList();
          that.selectedCollection = null;
        });
      this.getCollectionList();
    },

    collectionDel: function () {},

    getCollectionImgs: function () {
      var that = this;
      this.collectionCoverSelOptions = [];
      axios
        .post("/collectiongetPhotos", {
          Id: this.selectedCollection,
          Type: this.collection.Type,
        })
        .then(function (res) {
          if (res.data.length != 0) {
            res.data.forEach((element) => {
              that.collectionCoverSelOptions.push({
                value: element.Id,
                text: element.Image,
              });
            });
            that.collectionCoverSelectDisabled = false;
          } else {
            that.collectionCoverSelectDisabled = true;
          }
          that.collection.Imgs = res.data;
        });
    },

    getCollection() {
      var that = this;
      axios
        .post("/collectionSingle", { Id: this.selectedCollection })
        .then(function (res) {
          that.collection.Titre = res.data.Titre;
          that.collection.Cover = res.data.Cover;
          that.collection.Type = res.data.Type;
          that.getCollectionImgs();
        });
    },

    collectionCoverPreview() {},

    // gestion de photos

    imgsUploaded() {
      var photosArray = [];
      this.photos.files = new FormData();
      var url = null;
      for (var i = 0; i < this.photos.imgs.length; i++) {
        url = URL.createObjectURL(this.photos.imgs[i]);
        photosArray.push(url);
        this.photos.files.append("files", this.photos.imgs[i]);
      }
      this.photos.imgs = photosArray;
      this.photosPreviewed = true;
    },

    imageStore() {
      if (this.photosPreviewed == false) {
        this.imgsUploaded();
      }

      if (this.photos.collectionID != null)
        axios.post("/photoCreate", this.photos).then(console.log("yessss"));
    },

    // gestion de videos

    getVideoList() {
      this.videoList = [];
      this.videoSelOptions = [];
      var that = this;
      axios.get("/videoList").then(function (res) {
        res.data.forEach(function (element) {
          that.videoList.push(element);
          that.videoSelOptions.push({ value: element.Id, text: element.Titre });
        });
      });
    },

    // affichage de la preview vidéo
    videoPreview() {
      // debugger;
      if (this.onPreview == false) {
        if (this.video.lien != "") {
          this.ytbID = this.$youtube.getIdFromUrl(this.video.lien);
          console.log(this.ytbID);
          if (this.ytbID != null) {
            this.onPreview = true;
          }
        }
      } else {
        this.onPreview = false;
      }
    },

    // création de vidéo
    videoCreate() {
      if (this.video.Titre != "" && this.video.lien != "") {
        axios.post("/videoCreate", this.video).then(function (res) {
          console.log(res.data);
        });
        this.videoList.push(this.video);
      }
    },

    videoEdit() {
      var that = this;
      axios
        .post("/videoEdit", {
          Id: this.selectedVideo,
          Titre: this.video.Titre,
          Lien: this.video.lien,
        })
        .then(function (res) {
          console.log(res.data);
          that.action = "";
          that.getVideoList();
          that.selectedVideo = null;
        });
      this.getVideoList();
    },

    getVideo() {
      var that = this;
      axios
        .post("/videoSingle", { Id: this.selectedVideo })
        .then(function (res) {
          that.video.Titre = res.data.Titre;
          that.video.lien = res.data.Lien;
        });
    },

    delVideo() {
      var that = this;
      axios
        .post("/videoDelete", { Id: this.selectedVideo })
        .then(function (res) {
          that.delSucessToast();
          that.action = "";
          that.getVideoList();
          that.selectedVideo = null;
        });
    },

    delSucessToast() {
      this.$bvToast.toast("tout s'est bien passé", {
        title: "élement supprimé",
        variant: "success",
        toaster: "b-toaster-top-right",
        solid: true,
      });
    },
  },
};
</script>

<style>
.catButton {
  width: 100%;
}
</style>
