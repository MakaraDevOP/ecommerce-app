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
				:breakpoints="{ '960px': '75vw', '640px': '100vw' }"
				:style="{ width: '50vw' }"
			>
				<div class="py-2 grid grid-cols-2 gap-4">
					<div class="flex flex-col space-y-4">
						<!-- <InputText
							v-model="contact.full_name"
							placeholder="full name"
						/> -->
						<InputText
							v-model="contact.name"
							placeholder="name"
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
					<div>
						<Textarea
							v-model="contact.description"
							placeholder="description"
							rows="4"
							class="w-full"
						/>
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