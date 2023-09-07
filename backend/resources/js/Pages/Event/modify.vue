<template>
     



    <div class="py-2" v-for="events in this.eventsList" v-bind:key="events.id">
       <div class = "mx-4 bg-gray-300 rounded shadow p-4 w-1/4">
           <h2>Modifie l'évènement</h2> 
           <form>
           <div class="form-group"><label>({{ events.nom }})</label><input v-model="form.nom" type="nom" placeholder="renomme l'évènement"/></div>
           <div class="form-group"><label>({{ events.description }})</label><input v-model="form.description" type="text" id="description" placeholder="Change la description"/></div>
           <div class="form-group"><label>({{ events.place }})</label><input v-model="form.place" type="text" id="place" placeholder="Change le lieu"/></div>
           <div class="form-group"><label>({{ events.start_date }})</label><input v-model="form.start_date" type="date" id="date"></div>
           <button @click="modify(events.id)" type="button" class="update">Modifier</button>
           </form>
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
   
       async modify(eventId) {
       try {
           const existingEvent = this.eventsList.find(event => event.id === eventId);

       
           const updatedData = {
               nom: this.form.nom || existingEvent.nom,
               description: this.form.description || existingEvent.description,
               place: this.form.place || existingEvent.place,
               start_date: this.form.start_date || existingEvent.start_date,
           };
           const response = await axios.post(`/update/${eventId}`, updatedData);

           this.form.nom = null;
           this.form.description = null;
           this.form.place = null;
           this.form.start_date = null;
           window.location.href = '/events';

       } catch (error) {

           console.error(error);
       }
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