<template>
  <div class="grid grid-cols-3 gap-4 p-2">
    <div class="col-span-2 border rounded shadow bg-gray-50">
      <div>
        <DataTable :value="products" stripedRows responsiveLayout="scroll" class="p-datatable-sm">
          <Column field="code" header="Code"></Column>
          <Column field="name" header="Name"></Column>
          <Column field="category" header="Category"></Column>
          <Column field="quantity" header="Quantity"></Column>
        </DataTable>
      </div>
    </div>
    <div class="border rounded shadow bg-gray-50">
      <div class="w-full h-auto p-5">
        <Chart type="doughnut" :data="chartData" :options="lightOptions" />
      </div>
    </div>
  </div>
</template>
<script>
import Chart from 'primevue/chart';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

export default {
  components: { Chart, DataTable, Column },
  data() {
    return {
      chartData: {
        labels: ['FaceAzure Destop', 'FaceAzure Online', 'Quickbooks', 'Avast', 'TSPlus', 'Pro', 'Premire', 'HTML', 'CSS', 'JS', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
          {
            data: [300, 50, 100, 2, 40, 70, 80, 99, 200, 65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 10],
            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
            hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
          }
        ]
      },
      lightOptions: {
        plugins: {
          legend: {
            labels: {
              color: '#495057'
            }
          }
        }
      }
    }
  }
}
</script>