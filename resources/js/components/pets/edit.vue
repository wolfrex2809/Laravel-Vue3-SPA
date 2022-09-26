<template>
	<div class="container">
		<h2>Editar Mascota</h2>
		<br>
		<div class="card alert alert-success">
			<div class="card-body">
				<form @submit.prevent="sendUpdate">
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
						<button type="submit" class="btn btn-success" style="width: 15vh;"><i class="fa fa-check"></i> Actualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		name: "update-pet",
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
			document.querySelector('#loader-content').removeAttribute('hidden')
			this.loadRaces()
			this.loadPet()
		},
		methods:{
			async sendUpdate(){

				document.querySelector('#loader-content').removeAttribute('hidden')

				await axios.post('/api/pet/update/'+this.$route.params.id, this.pet)

				.then(response=>{
					if(response.data.success){
						this.$router.push('/pets')
					}
					document.querySelector('#loader-content').setAttribute('hidden', true)
					alert(response.data.msg)
				})
				.catch(error=>{

					document.querySelector('#loader-content').setAttribute('hidden', true)
					alert('No se pudo guardar la Mascota.')
				})
			},

			async loadRaces(){

				await axios.get('/api/race')
				.then(response=>{

					this.races = response.data
				})
				.catch(error=>{

					alert('No se pudo obtener la Informacion de la Mascota.')
					this.$router.push('/pets')
				})
			},
			async loadPet(){

				await axios.get('/api/pet/'+this.$route.params.id)
				.then(response=>{

					if (response.data.success) {
						this.pet = response.data.pet
					}else{
						alert(response.data.msg)
					}
					document.querySelector('#loader-content').setAttribute('hidden', true)

				})
				.catch(error=>{

					alert('No se pudo obtener la lista de Razas.')
					document.querySelector('#loader-content').setAttribute('hidden', true)
					this.$router.push('/pets')
				})
			}
		}
	}
</script>