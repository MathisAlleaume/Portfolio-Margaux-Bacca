<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" id="categories">
          <div class="card-header">Catégorie :</div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setCategorie('Video')"
                >Vidéo</b-button>
              </div>
              <div class="col-md-3">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setCategorie('Photo')"
                >Photo</b-button>
              </div>
              <div class="col-md-3">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setCategorie('Dessin')"
                >Dessin</b-button>
              </div>
              <div class="col-md-3">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setCategorie('Collections')"
                >Collections</b-button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" v-if="categorie== 'Photo'">
          <div class="card-header">Photo</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <b-button class="catButton" variant="success" v-on:click="setAction('add')">Ajouter</b-button>
              </div>

              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setAction('edit')"
                >Modifier</b-button>
              </div>
              <div class="col-md-4">
                <b-button class="catButton" variant="danger" v-on:click="setAction('del')">Supprimer</b-button>
              </div>
            </div>
            <hr />
          </div>
        </div>

        <div class="card" v-if="categorie== 'Video'">
          <div class="card-header">Vidéo</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <b-button class="catButton" variant="success" v-on:click="setAction('add')">Ajouter</b-button>
              </div>

              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setAction('edit')"
                >Modifier</b-button>
              </div>
              <div class="col-md-4">
                <b-button class="catButton" variant="danger" v-on:click="setAction('del')">Supprimer</b-button>
              </div>
            </div>
            <hr v-if="action == 'add'">
            <hr v-if="action == 'edit'">
            <hr v-if="action == 'del'">
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
                  <youtube :video-id="ytbID" ref="youtube" v-if="onPreview == true"></youtube>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="row" v-if="action == 'add'">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                  <b-button variant="success" v-on:click="videoCreate()">Enregistrer</b-button>
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
                <div class="col-md-1" style="padding-left: 0px;">
                  <b-button v-on:click="videoPreview()">preview</b-button>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <youtube :video-id="ytbID" ref="youtube" v-if="onPreview == true"></youtube>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                  <b-button variant="success" v-on:click="videoCreate()">Enregistrer</b-button>
                </div>
                <div class="col-md-5"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="card" v-if="categorie== 'Dessin'">
          <div class="card-header">Dessins</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <b-button class="catButton" variant="success" v-on:click="setAction('add')">Ajouter</b-button>
              </div>

              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setAction('edit')"
                >Modifier</b-button>
              </div>
              <div class="col-md-4">
                <b-button class="catButton" variant="danger" v-on:click="setAction('del')">Supprimer</b-button>
              </div>
            </div>
            <hr />
          </div>
        </div>

        <div class="card" v-if="categorie== 'Collections'">
          <div class="card-header">Collections</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <b-button class="catButton" variant="success" v-on:click="setAction('add')">Ajouter</b-button>
              </div>

              <div class="col-md-4">
                <b-button
                  class="catButton"
                  variant="primary"
                  v-on:click="setAction('edit')"
                >Modifier</b-button>
              </div>
              <div class="col-md-4">
                <b-button class="catButton" variant="danger" v-on:click="setAction('del')">Supprimer</b-button>
              </div>
            </div>
            <hr />
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
      photo: {
        Titre: "",
        img: "",
        collectionID: null,
      },
      video: {
        Titre: "",
        lien: "",
      },
      collection: {
        Titre: "",
      },
      dessin: {
        Titre: "",
        img: "",
        collectionID: null,
      },
      photoList: [],
      videoList: [],
      collectionList: [],
      dessinList: [],
      selectedVideo: null,
      selectedPhoto: null,
      selectedDessin: null,
      selectedCollection: null,
      videoSelOptions: [],
      ytbID: null,
      onPreview: false,
    };
  },
  mounted() {
    var that = this;
    // get list collection
    // axios.get("/CVMargaux/CV/public/collectionsList").then(function (res) {
    //   res.data.forEach((element) => that.collectionsList.push(element));
    // });

    // get list photo
    // axios.get("/CVMargaux/CV/public/photoList").then(function (res) {
    //   res.data.forEach((element) => that.photoList.push(element));
    // });

    // get list dessin
    // axios.get("/CVMargaux/CV/public/dessinList").then(function (res) {
    //   res.data.forEach((element) => that.dessinList.push(element));
    // });

    // get list vidéos
    axios.get("/CVMargaux/CV/public/videoList").then(function (res) {
      res.data.forEach(function (element) {
        that.videoList.push(element);
        that.videoSelOptions.push({ value: element.Id, text: element.Titre });
      });
    });
  },
  methods: {
    setCategorie(cat) {
      this.categorie = cat;
      this.action = "";
    },

    setAction(action) {
      this.action = action;
    },

    // gestion de videos

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
        axios
          .post("/CVMargaux/CV/public/videoCreate", this.video)
          .then(function (res) {
            console.log(res.data);
          });
        this.videoList.push(this.video);
      }
    },

    getVideo() {
      var that = this;
      axios
        .post("/CVMargaux/CV/public/videoSingle", { Id: this.selectedVideo })
        .then(function (res) {
          that.video.Titre = res.data.Titre;
          that.video.lien = res.data.Lien;
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
