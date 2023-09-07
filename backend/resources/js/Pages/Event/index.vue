<template>
     

     
    <h1 class="font-bold">Liste des évènements</h1>
    <button @click="showModal = true" class="add">
    Ajouter un événement
  </button>

  <div v-if="showModal" class="modal-overlay">
    <div class="modal">
      <h2>Rentre les données</h2>
      <form @submit.prevent="submit">
        <div class="form-group">
          <label for="nom">Nom de ton évènement</label>
          <input type="text" id="nom" placeholder="Nom de ton évènement" v-model="form.nom" />
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" id="description" placeholder="Description" v-model="form.description" />
        </div>
        <div class="form-group">
          <label for="date">Date de ton évènement</label>
          <input type="date" id="date" placeholder="Date de ton évènement" v-model="form.start_date" />
        </div>
        <div class="form-group">
          <label for="place">Localisation</label>
          <input type="text" id="place" placeholder="Ou se trouve ton évènement" v-model="form.place"/>
        </div>
        <div class="btn-group">
          <button type="submit" class="add">Ajouter</button>
          <button @click="closeModal">Fermer</button>
        </div>
        
      </form>
    </div>
  </div>

     <div class="py-2" v-for="events in this.eventsList" v-bind:key="events.id">
        <div class = "mx-4 bg-gray-300 rounded shadow p-4 w-1/4">
            <div>{{ events.nom }}</div>
            <div>{{ events.description }}</div>
            <div>{{ events.place }}</div>
            <div>{{ events.start_date }}</div>
            <button @click="test(events.id)" type="button" class="delete">Supprimer</button>
            <button @click="modify(events.id)" type="button" class="update">Modifier</button>
        </div>

        
     </div>


       
    
</template>

<script>
import AppLayout from './../../Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout
    },

    data() {
        return {
            eventsList: this.events,
            showModal: false,
            form: {
              nom: null,
              description: null,
              start_date: null,
              place: null,
            },
        }
    },

    props: ['events'],

    mounted() {
        console.log(this.eventsList);
    },

    methods: {
        closeModal(){
            this.showModal = false;
        },
        submit(){
          this.$inertia.post('/add' , this.form);
          window.location.href = '/events';
        },
        test(eventId){
          console.log(eventId);
          this.$inertia.post('/delete/' + eventId);
          window.location.href = '/events';
        },
        modify(eventId){
          console.log(eventId);
          this.$inertia.post('/update/' + eventId);
          window.location.href = `/events/${eventId}`;
        }

    }
}   
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal {
  background-color: white;
  padding: 20px;
  border-radius: 4px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 10px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
input[type="date"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.btn-group {
  margin-top: 20px;
}

button {
  padding: 10px 20px;
  margin-right: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.delete {
  background-color: red;
  color: white;
}

.add{
  background-color: green;
  color: white;
}

.update{
  background-color: blue ;
  color: white
}

body{
  background-color: linear-gradient(to left, rgb(255, 0, 255), rgb(94, 0, 148));
}



</style>