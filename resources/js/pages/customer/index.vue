<template>
	<div class="">
		<div class="border rounded  ">
			<div class="h-[calc(100vh-4.1rem)]">
				<DataTable
					ref="dt"
					:value="customers"
					@row-dblclick="doubleClick"
					v-model:selection="selectCustomer"
					selectionMode="single"
					dataKey="id"
					:paginator="true"
					:maximizable="true"
					:modal="true"
					scrollHeight="flex"
					:scrollable="true"
					scrollDirection="both"
					showGridlines
					stripedRows
					responsiveLayout="scroll"
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
								<div class="text-left text-lg">Customers</div>
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
					<Column
						field="company_name"
						header="Customer Name"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						field="province_city"
						header="Province City"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						field="detail_address"
						header="Detail Address"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						field="email"
						header="Email"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						field="phone"
						header="Phone"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						field="is_active"
						header="Is active"
						style="flex-grow: 0; flex-basis: 100px;"
					>
						<template #body="slot">
							<div class="flex space-x-2">
								<span
									class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded-full"
									v-if="slot.data.is_active == '0'"
								>Inactive</span>
								<span
									class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-200 text-green-700 rounded-full"
									v-if="slot.data.is_active == '1'"
								>Active</span>
							</div>
						</template>
					</Column>
					<Column
						header="Actions"
						style="flex-grow: 0; flex-basis: 100px;"
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
				header="Customer"
				v-model:visible="showDialog"
				:breakpoints="{ '960px': '75vw', '640px': '100vw' }"
				:style="{ width: '50vw' }"
			>
				<div class="py-2 grid grid-cols-2 gap-4">
					<div class="flex flex-col space-y-4">
						<InputText
							v-model="customer.company_name"
							placeholder="company name"
						/>
						<InputText
							v-model="customer.phone"
							placeholder="phone"
						/>
						<InputText
							v-model="customer.email"
							placeholder="email"
						/>
						<Dropdown
							v-model="customer.parent_company_id"
							:options="parentCompany"
							optionLabel="company_name"
							optionValue="id"
						/>
						<div class="field-checkbox">
							<Checkbox
								v-model="customer.is_active"
								:binary="true"
								trueValue="1"
								falseValue="0"
								inputId="is_active"
							/>
							<label
								for="is_active"
								class="px-2"
							>is active</label>
						</div>
					</div>
					<div class=" flex flex-col space-y-4">
						<InputText
							v-model="customer.province_city"
							placeholder="province city"
							class="w-full"
						/>
						<Textarea
							v-model="customer.detail_address"
							placeholder="detail address"
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
			selectCustomer: {},
			parentCompany: []
		}
	},
	computed: {
		...mapGetters({
			customers: 'customer/customers',
			customer: 'customer/customer',
		})
	},
	mounted() {
		this.$store.dispatch('customer/GET_CUSTOMER')
	},
	methods: {
		doubleClick() {
			this.parentCompany = [];
			this.customers.forEach((element) => {
				element.id = element.id?.toString();
				if (element.id != this.selectCustomer.id)
					this.parentCompany = [...this.parentCompany, element]
			});
			this.$store.dispatch('customer/GET_ID_CUSTOMER', this.selectCustomer.id).then(respnse => {
				if (respnse) {
					this.showDialog = true
				}
			})
		},
		edit(id) {
			this.selectCustomer = { id: id }
			this.parentCompany = [];
			this.customers.forEach((element) => {
				element.id = element.id?.toString();
				if (element.id != this.selectCustomer.id)
					this.parentCompany = [...this.parentCompany, element]
			});
			this.$store.dispatch('customer/GET_ID_CUSTOMER', id).then(respnse => {
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
					this.$store.dispatch('customer/DESTROY_CUSTOMER', id).then(respnse => {
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
			this.parentCompany = [];
			this.customers.forEach((element) => {
				element.id = element.id?.toString();
				this.parentCompany = [...this.parentCompany, element]
			});
			this.$store.commit('customer/ADD_CUSTOMER')
		},
		cancel() {
			this.showDialog = false;
			this.$store.commit('customer/ADD_CUSTOMER')
		},
		createORupdateProduct() {
			// UPDATED
			if (this.customer.id != null)
				this.$store.dispatch('customer/UPDATE_CUSTOMER').then(respnse => {
					if (respnse) {
						this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Updated successfully', life: 3000 });
						this.showDialog = false
					}
				}).catch(error => {
					this.$toast.add({ severity: 'error', summary: 'Error Message', detail: error, life: 3000 });
				})
			// CREATED
			else
				this.$store.dispatch('customer/CREATE_CUSTOMER').then(respnse => {
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