<template>
  <div class=" p-2">
    <div class="border rounded  ">
      <div class="h-[calc(100vh-4.1rem)]">
        <DataTable :value="product" :paginator="true" :maximizable="true" :modal="true" scrollHeight="flex" :scrollable="true" scrollDirection="both" showGridlines stripedRows responsiveLayout="scroll" class="p-datatable-sm text-xs" style="font-size:12px !important" :rows="10" paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown" :rowsPerPageOptions="[10, 20, 50]" currentPageReportTemplate="Showing {first} to {last} of {totalRecords}">
          <template #header>
            <div class="flex justify-between items-center">
              <div class="text-left text-lg">
                Products
              </div>
              <div class="flex space-x-2">
                <Button label="Export" icon="pi pi-plus" class="p-button-secondary p-button-sm" iconPos="left" />
                <Button label="Add" icon="pi pi-plus" class="p-button-sm p-button-info" iconPos="left" />
              </div>
            </div>
          </template>
          <Column selectionMode="multiple" headerStyle="width: 3rem" style="flex-grow: 0; flex-basis: 50px;"></Column>
          <Column field="type" header="Type" style="flex-grow: 1; flex-basis: 50px;"></Column>
          <Column field="name" header="Name" style="flex-grow: 1; flex-basis: 200px;"></Column>
          <Column field="description" header="Description" style="flex-grow: 1; flex-basis: 200px;"></Column>
          <Column field="is_active" header="Is active" style="flex-grow: 0; flex-basis: 100px;"></Column>
        </DataTable>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex"
export default {
  components: { mapGetters },
  data() {
    return {
    }
  },
  computed: {
    ...mapGetters({
      product: 'product/product',
    })
  },
  mounted() {
    this.$store.dispatch('product/GET_PRODUCT')
  }
}
</script>