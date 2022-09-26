<template>
	<div class="container">
		<h2>Crear Mascota</h2>
		<br>
		<div class="card alert alert-success">
			<div class="card-body">
				<form @submit.prevent="sendCreate">
					<div class="row">
						<div class="col-md-6 form-group mb-3">
							<label>Nombre</label>
							<input type="text" class="form-control" v-model="pet.name" required>
						</div>

						<div class="col-md-6 form-group mb-3">
							<label>Raza</label>
							<select v-model="pet.race_id" class="form-control" required>
								<option :value="race.id" v-for="race in races">{{ race.description }}</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 form-group mb-3" form-group>
							<label>Dirección</label>
							<textarea class="form-control" v-model="pet.address" rows="1" required ></textarea>
						</div>
						<div class="col-md-4 form-group mb-3">
							<label>Estado</label>
							<select v-model="pet.status" class="form-control" required>
								<option value="D" selected>Disponible</option>
								<option value="P" >En Proceso</option>
								<option value="A" >Adoptado</option>
							</select>
						</div>
					</div>
					<br>
					<div class="row d-flex flex-row-reverse">
						<button type="submit" class="btn btn-success" style="width: 13vh;"><i class="fa fa-check"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		name: "create-pet",
		data(){
			return{
				pet:{
					name: "",
					address: "",
					race_id: 0,
					status: ""
				},
				races: []
			}
		},
		mounted(){
			this.loadRaces()
		},
		methods:{
			async sendCreate(){
				document.querySelector('#loader-content').removeAttribute('hidden')
				await axios.post('/api/pet/store', this.pet)
				.then(response=>{
					document.querySelector('#loader-content').setAttribute('hidden', true)
					this.$router.push('/pets')
				})
				.catch(error=>{
					document.querySelector('#loader-content').setAttribute('hidden', true)
					alart('No se pudo guardar la Mascota.')
				})
			},

			async loadRaces(){
				await axios.get('/api/race')
				.then(response=>{
					this.races = response.data
				})
				.catch(error=>{
					alart('No se pudo obtener la lista de Razas.')
				})
			}
		}
	}
</script>