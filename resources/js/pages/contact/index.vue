<template>
	<div class="">
		<div class="border rounded  ">
			<div class="h-[calc(100vh-4.1rem)]">
				<DataTable
					ref="dt"
					:value="contacts"
					@row-dblclick="doubleClick"
					v-model:selection="selectContact"
					selectionMode="single"
					dataKey="id"
					:paginator="true"
					scrollHeight="flex"
					:scrollable="true"
					scrollDirection="both"
					showGridlines
					stripedRows
					class="p-datatable-sm text-xs"
					style="font-size:12px !important"
					:rows="10"
					paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
					:rowsPerPageOptions="[10, 20, 50]"
					currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
				>
					<template #header>
						<div class="flex justify-between items-center">
							<div class="text-left flex space-x-2  items-center">
								<div class="text-left text-lg">Category</div>
								<div class="py-1">
									<InputText
										placeholder="Search"
										type="text"
									/>
								</div>
							</div>
							<div class="flex space-x-2">
								<Button
									label="Export"
									icon="pi pi-file-excel"
									class="p-button-secondary p-button-sm"
									iconPos="left"
									@click="exportCSV($event)"
								/>
								<Button
									label="Add"
									icon="pi pi-plus"
									class="p-button-sm p-button-info"
									iconPos="left"
									@click="openDialog"
								/>
							</div>
						</div>
					</template>
					<Column
						selectionMode="multiple"
						headerStyle="width: 3rem"
						style="flex-grow: 0; flex-basis: 50px;"
					></Column>
					<!-- <Column
						field="title"
						header="Title"
						style="flex-grow: 0; flex-basis: 80px;"
					></Column> -->
					<!-- <Column
						field="full_name"
						header="Full Name"
						style="flex-grow: 1; flex-basis: 150px;"
					></Column> -->
					<!-- <Column
						field="contact_phone"
						header="Phone"
						style="flex-grow: 1; flex-basis: 100px;"
					></Column> -->
					<!-- <Column
						field="contact_email"
						header="Email"
						style="flex-grow: 1; flex-basis: 150px;"
					></Column> -->
					<Column
						field="name"
						header="Name"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						field="description"
						header="Description"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>

					<Column
						header="Actions"
						style="flex-grow: 0; flex-basis: 100px;"
						alignFrozen="right"
						:frozen="true"
					>
						<template #body="slot">
							<div class="flex space-x-2">
								<Button
									icon="pi pi-file-edit"
									class="p-button-sm p-button-info"
									@click="edit(slot.data.id)"
								/>
								<Button
									icon="pi pi-trash"
									class="p-button-sm p-button-danger"
									@click="destroy(slot.data.id)"
								/>
							</div>
						</template>
					</Column>
					<template #empty>
						<div class="w-full text-center"> No items found. 😋</div>
					</template>
				</DataTable>
			</div>
			<Dialog
				header="Category"
				v-model:visible="showDialog"
				:breakpoints="{ '960px': '55vw', '640px': '50vw' }"
				:style="{ width: '30vw' }"
			>
				<div class="py-2 ">
					<div class="card mb-4">
						<div> Photo</div>
						<form id="filesUp">
							<div class="large-12 medium-12 small-12 cell flex space-x-2">
								<div>
									<Image
										:src="contact.img??'storage/images/07312023185610_err.png'"
										alt="Image"
										width="140"
										height="140"
										preview
									/>
								</div>
								<div class="text-gray-800 text-sm h-14 object-cover  w-28 relative">
									<div class="flex items-center justify-center w-full">
										<label
											for="dropzone-file"
											class="flex flex-col items-center justify-center w-full h-20 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
										>
											<div class="flex flex-col items-center justify-center pt-5 pb-5">
												<svg
													class="w-8 h-8 text-gray-500 dark:text-gray-400"
													aria-hidden="true"
													xmlns="http://www.w3.org/2000/svg"
													fill="none"
													viewBox="0 0 20 16"
												>
													<path
														stroke="currentColor"
														stroke-linecap="round"
														stroke-linejoin="round"
														stroke-width="2"
														d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
													/>
												</svg>

											</div>
											<input
												id="dropzone-file"
												type="file"
												accept="image/*"
												name="files"
												ref="files"
												@change="uploadFile"
												class="hidden"
											/>
										</label>
									</div>

								</div>

							</div>
						</form>

					</div>
					<div class="flex flex-col space-y-4">
						<InputText
							v-model="contact.name"
							placeholder="name"
						/>
						<Textarea
							v-model="contact.description"
							placeholder="description"
							rows="4"
							class="w-full"
						/>
						<!-- <InputText
							v-model="contact.email"
							placeholder="email"
						/> -->
						<!-- <Dropdown
							v-model="contact.title"
							:options="productType"
							optionLabel="name"
							optionValue="name"
							placeholder="tilte"
						/> -->
						<!-- <Dropdown
							v-model="contact.company_id"
							:options="customers"
							optionLabel="company_name"
							optionValue="id"
							placeholder="company name"
						/> -->
						<!-- <div class="field-checkbox">
							<Checkbox
								v-model="contact.is_active"
								:binary="true"
								trueValue="1"
								falseValue="0"
								inputId="is_active"
							/>
							<label
								for="is_active"
								class="px-2"
							>is active</label>
						</div> -->
					</div>

				</div>
				<template #footer>
					<Button
						label="Cancel"
						icon="pi pi-times"
						@click="cancel"
						class="p-button-text p-button-secondary"
					/>
					<Button
						label="Save"
						icon="pi pi-check"
						@click="createORupdateProduct"
						autofocus
						class="p-button-info"
					/>
				</template>
			</Dialog>
		</div>
	</div>
</template>
<script>
import { mapGetters } from "vuex"
export default {
	layout: 'client',
	components: { mapGetters },
	data() {
		return {
			showDialog: false,
			selectContact: {},
			productType: [
				{ name: 'Mr.', code: '1' },
				{ name: 'Ms.', code: '2' },
			],
			dataCompany: [],
		}
	},
	computed: {
		...mapGetters({
			contacts: 'contact/contacts',
			contact: 'contact/contact',
			customers: 'customer/customers'
		})
	},
	mounted() {
		this.$store.dispatch('contact/GET_CONTACT')
		this.$store.dispatch('customer/GET_CUSTOMER')
	},
	watch: {
		customers() {
			this.customers.forEach(element => {
				element.id = element.id?.toString();
			});
		}
	},
	methods: {
		uploadFile() {
			var data = new FormData()
			var file = this.$refs.files.files[0]
			data.append('files', file);
			this.$store.dispatch('upload/UPLOAD_FILE', { data: data }).then((respnse) => {
				this.$toast.add({ severity: 'success', summary: 'Uploaded', detail: 'Data Uploaded', life: 3000 });
				this.contact.img = 'http://127.0.0.1:8000/storage/images/' + respnse.data.file.file_path
			})
		},
		doubleClick() {
			this.$store.dispatch('contact/GET_ID_CONTACT', this.selectContact.id).then(respnse => {
				if (respnse) {
					this.showDialog = true
				}
			})
		},
		edit(id) {
			this.$store.dispatch('contact/GET_ID_CONTACT', id).then(respnse => {
				if (respnse) {
					this.showDialog = true
				}
			})
		},
		destroy(id) {
			this.$confirm.require({
				target: event.currentTarget,
				message: 'Are you sure you want to proceed?',
				icon: 'pi pi-exclamation-triangle',
				accept: () => {
					this.$store.dispatch('contact/DESTROY_CONTACT', id).then(respnse => {
						if (respnse) {
							this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Deleted successfully', life: 3000 });
						}
					})
				},
				reject: () => {
					this.$toast.add({ severity: 'info', summary: 'Infomation Message', detail: 'Rejected', life: 3000 });
				}
			});

		},
		openDialog() {
			this.showDialog = true;
			this.$store.commit('contact/ADD_CONTACT')
		},
		cancel() {
			this.showDialog = false;
			this.$store.commit('contact/ADD_CONTACT')
		},
		createORupdateProduct() {
			// UPDATED
			if (this.contact.id != null)
				this.$store.dispatch('contact/UPDATE_CONTACT').then(respnse => {
					if (respnse) {
						this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Updated successfully', life: 3000 });
						this.showDialog = false
					}
				}).catch(error => {
					this.$toast.add({ severity: 'error', summary: 'Error Message', detail: error, life: 3000 });
				})
			// CREATED
			else
				this.$store.dispatch('contact/CREATE_CONTACT').then(respnse => {
					if (respnse) {
						this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Created successfully', life: 3000 });
						this.showDialog = false
					}
				}).catch(error => {
					this.$toast.add({ severity: 'error', summary: 'Error Message', detail: error, life: 3000 });
				})

		},

		exportCSV() {
			this.$refs.dt.exportCSV();
		}
	}
}
</script>