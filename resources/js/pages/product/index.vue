<template>
  <div class="">
    <div class="border rounded  ">
      <div class="h-[calc(100vh-4.1rem)]">
        <DataTable ref="dt" :value="products" @row-dblclick="doubleClick" v-model:selection="selectProduct" selectionMode="single" dataKey="id" :paginator="true" :maximizable="true" :modal="true" scrollHeight="flex" :scrollable="true" scrollDirection="both" showGridlines stripedRows responsiveLayout="scroll" class="p-datatable-sm text-xs" style="font-size:12px !important" :rows="10" paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown" :rowsPerPageOptions="[10, 20, 50]" currentPageReportTemplate="Showing {first} to {last} of {totalRecords}">
          <template #header>
            <div class="flex justify-between items-center">
              <div class="text-left flex space-x-2  items-center">
                <div class="text-left text-lg">Products</div>
                <div class="py-1">
                  <InputText placeholder="Search" type="text" />
                </div>
              </div>
              <div class="flex space-x-2">
                <!-- Button Export -->
                <Button label="Export" icon="pi pi-file-excel" class="p-button-secondary p-button-sm" iconPos="left" />
                <Button label="Add" icon="pi pi-plus" class="p-button-sm p-button-info" iconPos="left" @click="openDialog" />
              </div>
            </div>
          </template>
          <Column selectionMode="multiple" headerStyle="width: 3rem" style="flex-grow: 0; flex-basis: 50px;"></Column>
          <Column field="type" header="Type" style="flex-grow: 1; flex-basis: 50px;"></Column>
          <Column field="name" header="Name" style="flex-grow: 1; flex-basis: 200px;"></Column>
          <Column field="description" header="Description" style="flex-grow: 1; flex-basis: 200px;"></Column>
          <Column field="is_active" header="Is active" style="flex-grow: 0; flex-basis: 100px;">
            <template #body="slot">
              <div class="flex space-x-2">
                <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded-full" v-if="slot.data.is_active == '0'">Inactive</span>
                <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-200 text-green-700 rounded-full" v-if="slot.data.is_active == '1'">Active</span>
              </div>
            </template>
          </Column>
          <Column header="Actions" style="flex-grow: 0; flex-basis: 100px;">
            <template #body="slot">
              <div class="flex space-x-2">
                <Button icon="pi pi-file-edit" class="p-button-sm p-button-info" @click="edit(slot.data.id)" />
                <Button icon="pi pi-trash" class="p-button-sm p-button-danger" @click="destroy(slot.data.id)" />
              </div>
            </template>
          </Column>
        </DataTable>
      </div>
      <Dialog header="Product" v-model:visible="showDialog" :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }">
        <div class="py-2 grid grid-cols-2 gap-4">
          <div class="flex flex-col space-y-4">
            <InputText v-model="product.name" placeholder="product name" />
            <Dropdown v-model="product.type" :options="productType" optionLabel="name" optionValue="name" />
            <div class="field-checkbox">
              <Checkbox v-model="product.is_active" :binary="true" trueValue="1" falseValue="0" inputId="is_active" />
              <label for="is_active" class="px-2">is active</label>
            </div>
          </div>
          <div>
            <Textarea v-model="product.description" placeholder="description" rows="4" class="w-full" />
          </div>
        </div>
        <template #footer>
          <Button label="Cancel" icon="pi pi-times" @click="cancel" class="p-button-text p-button-secondary" />
          <Button label="Save" icon="pi pi-check" @click="createORupdateProduct" autofocus class="p-button-info" />
        </template>
      </Dialog>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex"
export default {
  components: { mapGetters, exportJSONtoExcel },
  data() {
    return {
      showDialog: false,
      selectProduct: {},
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

  }
}
</script>