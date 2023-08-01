<template>
	<div class="">
		<div class="border rounded  ">
			<div class="h-[calc(100vh-4.1rem)]">
				<DataTable
					ref="dt"
					:value="products"
					@row-dblclick="doubleClick"
					v-model:selection="selectProduct"
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
								<div class="text-left text-lg">Products</div>
								<div class="py-1">
									<InputText
										placeholder="Search"
										type="text"
									/>
								</div>
							</div>
							<div class="flex space-x-2">
								<!-- Button Export -->
								<Button
									label="Export"
									icon="pi pi-file-excel"
									class="p-button-secondary p-button-sm"
									iconPos="left"
									@click="exportExcel"
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
						field="name"
						header="Name"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						field="price"
						header="price"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						field="stock"
						header="stock"
						style="flex-grow: 1; flex-basis: 200px;"
					></Column>
					<Column
						header="Category"
						style="flex-grow: 1; flex-basis: 50px;"
					>
						<template #body="slot">
							<span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-200 text-blue-700 rounded-full">{{ slot.data.category?.name }}</span>

						</template>
					</Column>
					<Column
						field="description"
						header="Description"
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
				header="Product"
				v-model:visible="showDialog"
				:breakpoints="{ '960px': '75vw', '640px': '100vw' }"
				:style="{ width: '30vw' }"
			>
				<div class="py-2 ">
					<div class="flex flex-col space-y-4">
						<div class="card">
							<div> Photo</div>
							<form id="filesUp">
								<div class="large-12 medium-12 small-12 cell flex space-x-2">
									<div>
										<Image
											:src="product.img??'storage/images/07312023185610_err.png'"
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

						<InputText
							v-model="product.name"
							placeholder="product name"
						/>
						<InputText
							v-model="product.price"
							placeholder="product price"
						/>
						<InputText
							v-model="product.stock"
							placeholder="product stock"
						/>
						<Dropdown
							v-model="product.type"
							:options="productType"
							optionLabel="name"
							optionValue="id"
						/>
						<div class="field-checkbox">
							<Checkbox
								v-model="product.is_active"
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
						<Textarea
							v-model="product.description"
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
			selectProduct: {},
			preview: true
		}
	},
	computed: {
		...mapGetters({
			products: 'product/products',
			product: 'product/product',
			chartProduct: 'product/chartProduct',
			productType: 'product/productType'
		})
	},
	mounted() {
		this.$store.dispatch('product/GET_PRODUCT')
	},
	methods: {
		viewPhoto() {
			this.preview = true

		},
		uploadFile() {
			var data = new FormData()
			var file = this.$refs.files.files[0]
			data.append('files', file);
			this.$store.dispatch('upload/UPLOAD_FILE', { data: data }).then((respnse) => {
				this.$toast.add({ severity: 'success', summary: 'Uploaded', detail: 'Data Uploaded', life: 3000 });
				this.product.img = 'storage/images/' + respnse.data.file.file_path
			})
		},
		onAdvancedUpload(file) {
			const isJPG = file.type === 'image/jpeg' || file.type === 'image/png';
			const isLt2M = file.size / 1024 / 1024 < 2;
			if (!isJPG) {
				this.$toast.add({ severity: 'error', summary: 'error Message', detail: 'Avatar picture must be JPG format!', life: 3000 });
			}
			if (!isLt2M) {

				this.$toast.add({ severity: 'error', summary: 'error Message', detail: 'Avatar picture size can not exceed 2MB!', life: 3000 });
			}
			this.submitUplaod()
		},
		/*
		*  Function upload image 
		*/
		async submitUplaod() {
			const form = new FormData(document.getElementById('filesUp'));
			const config = {
				headers: { 'content-type': 'multipart/form-data' }
			}
			await axios.post('/files/create/upload', form, config).then(response => {
				this.ruleForm.photo_id = response.data.file.id
				this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Deleted successfully', life: 3000 });
			})
		},
		doubleClick() {
			this.$store.dispatch('product/GET_ID_PRODUCT', this.selectProduct.id).then(respnse => {
				if (respnse) {
					this.showDialog = true
				}
			})
		},
		edit(id) {
			this.$store.dispatch('product/GET_ID_PRODUCT', id).then(respnse => {
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
					this.$store.dispatch('product/DESTROY_PRODUCT', id).then(respnse => {
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
			this.$store.commit('product/ADD_PRODUCT')
		},
		cancel() {
			this.showDialog = false;
			this.$store.commit('product/ADD_PRODUCT')
		},
		createORupdateProduct() {
			// UPDATED
			if (this.product.id != null)
				this.$store.dispatch('product/UPDATE_PRODUCT').then(respnse => {
					if (respnse) {
						this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Updated successfully', life: 3000 });
						this.showDialog = false
					}
				}).catch(error => {
					this.$toast.add({ severity: 'error', summary: 'Error Message', detail: error, life: 3000 });
				})
			// CREATED
			else
				this.$store.dispatch('product/CREATE_PRODUCT').then(respnse => {
					if (respnse) {
						this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Created successfully', life: 3000 });
						this.showDialog = false
					}
				}).catch(error => {
					this.$toast.add({ severity: 'error', summary: 'Error Message', detail: error, life: 3000 });
				})

		},
		exportExcel() {
			import("../../plugins/Export2Excel").then((excel) => {
				// API get Data
				this.$store.dispatch('product/GET_PRODUCT').then(respone => {
					console.log(respone.data.Product)
					// data json
					const OBJ = respone.data.Product;
					// header in Excel
					const Header = ["Type", "Name", "Description", "IS Active"];
					// Field for map with ob data json
					const Field = ["type", "name", "description", "is_active"];
					// data mapped field and obj data
					const Data = this.FormatJSon(Field, OBJ);
					excel.export_json_to_excel({
						header: Header,
						data: Data,
						sheetName: "Name Of Sheets ",
						filename: "Product",
						autoWidth: true,
						bookType: "xlsx",
					})
				})
			})
		},
		// Funtion Format OBJ 
		FormatJSon(FilterData, JsonData) {
			return JsonData.map((v) => FilterData.map((j => {
				return v[j];
			})))
		}
	}
}
</script>