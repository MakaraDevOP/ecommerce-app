<template>
  <div class="grid grid-cols-3 gap-2 ">
    <div class="col-span-2 border rounded shadow bg-gray-50">
      <div>
        <DataTable :value="products" stripedRows responsiveLayout="scroll" class="p-datatable-sm">
          <Column field="type" header="Type"></Column>
          <Column field="name" header="Name"></Column>
          <Column field="description" header="Description"></Column>
        </DataTable>
      </div>
    </div>
    <div class="border rounded shadow bg-gray-50">
      <div class="w-full h-full  p-5">
        <Chart type="pie" :data="chartData" :options="lightOptions" style="width: 600px; height: 550px;" />
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
      chartData: {
        labels: [],
        datasets: [
          {
            data: [],
            backgroundColor: [
              "rgb(28,100,147)",
              "rgb(12,38,128)",
              "rgb(40,244,180)",
              "rgb(242,226,185)",
              "rgb(13,8,16)",
              "rgb(219,195,67)",
              "rgb(15,249,9)",
              "rgb(136,198,215)",
              "rgb(44,226,196)",
              "rgb(6,149,161)",
              "rgb(54,40,39)",
              "rgb(184,152,214)",
              "rgb(7,86,136)",
              "rgb(55,161,233)",
              "rgb(144,73,61)",
              "rgb(113,183,41)",
              "rgb(48,236,233)",
              "rgb(110,32,118)",
              "rgb(133,182,111)",
              "rgb(78,91,35)",
              "rgb(47,241,127)",
              "rgb(235,98,157)",
              "rgb(159,88,3)",
              "rgb(113,212,12)",
              "rgb(206,143,53)",
              "rgb(215,163,204)",
              "rgb(169,51,120)",
              "rgb(0,109,250)",
              "rgb(195,131,245)",
              "rgb(46,189,24)",
              "rgb(172,79,89)",
              "rgb(168,44,179)",
              "rgb(14,58,167)",
              "rgb(142,148,66)",
              "rgb(254,7,158)",
              "rgb(221,145,161)",
              "rgb(120,245,69)",
              "rgb(217,209,183)",
              "rgb(120,118,144)",
              "rgb(115,177,215)",
              "rgb(72,141,145)",
              "rgb(194,68,206)",
              "rgb(95,160,105)",
              "rgb(136,73,147)",
              "rgb(189,243,151)",
              "rgb(67,148,227)",
              "rgb(99,189,25)",
              "rgb(15,17,227)",
              "rgb(198,53,216)",
              "rgb(43,224,215)",
              "rgb(32,17,65)",
              "rgb(26,207,98)",
              "rgb(175,93,205)",
              "rgb(229,179,196)",
              "rgb(190,98,188)",
              "rgb(102,128,173)",
              "rgb(119,175,118)",
              "rgb(110,203,253)",
              "rgb(81,20,63)",
              "rgb(56,24,175)",
              "rgb(153,205,155)",
              "rgb(44,140,8)",
              "rgb(225,90,157)",
              "rgb(58,179,69)",
              "rgb(51,21,233)",
              "rgb(128,95,254)",
              "rgb(64,15,27)",
              "rgb(26,183,69)",
              "rgb(79,238,96)",
              "rgb(44,73,124)",
              "rgb(5,236,244)",
              "rgb(27,6,150)",
              "rgb(127,252,159)",
              "rgb(216,70,137)",
              "rgb(223,140,182)",
              "rgb(137,137,148)",
              "rgb(123,9,96)",
              "rgb(109,50,222)",
              "rgb(201,45,119)",
              "rgb(190,53,165)",
              "rgb(149,24,239)",
              "rgb(57,75,43)",
              "rgb(157,109,234)",
              "rgb(60,243,23)",
              "rgb(140,80,151)",
              "rgb(104,35,97)",
              "rgb(250,84,90)",
              "rgb(15,197,5)",
              "rgb(53,128,4)",
              "rgb(215,200,170)",
              "rgb(168,253,26)",
              "rgb(131,244,42)",
              "rgb(242,112,102)",
              "rgb(162,205,134)",
              "rgb(113,85,71)",
              "rgb(25,212,73)",
              "rgb(194,208,181)",
              "rgb(154,168,155)",
              "rgb(214,59,34)",
              "rgb(178,70,204)"
            ],
            hoverBackgroundColor: [
              "rgb(28,100,147)",
              "rgb(12,38,128)",
              "rgb(40,244,180)",
              "rgb(242,226,185)",
              "rgb(13,8,16)",
              "rgb(219,195,67)",
              "rgb(15,249,9)",
              "rgb(136,198,215)",
              "rgb(44,226,196)",
              "rgb(6,149,161)",
              "rgb(54,40,39)",
              "rgb(184,152,214)",
              "rgb(7,86,136)",
              "rgb(55,161,233)",
              "rgb(144,73,61)",
              "rgb(113,183,41)",
              "rgb(48,236,233)",
              "rgb(110,32,118)",
              "rgb(133,182,111)",
              "rgb(78,91,35)",
              "rgb(47,241,127)",
              "rgb(235,98,157)",
              "rgb(159,88,3)",
              "rgb(113,212,12)",
              "rgb(206,143,53)",
              "rgb(215,163,204)",
              "rgb(169,51,120)",
              "rgb(0,109,250)",
              "rgb(195,131,245)",
              "rgb(46,189,24)",
              "rgb(172,79,89)",
              "rgb(168,44,179)",
              "rgb(14,58,167)",
              "rgb(142,148,66)",
              "rgb(254,7,158)",
              "rgb(221,145,161)",
              "rgb(120,245,69)",
              "rgb(217,209,183)",
              "rgb(120,118,144)",
              "rgb(115,177,215)",
              "rgb(72,141,145)",
              "rgb(194,68,206)",
              "rgb(95,160,105)",
              "rgb(136,73,147)",
              "rgb(189,243,151)",
              "rgb(67,148,227)",
              "rgb(99,189,25)",
              "rgb(15,17,227)",
              "rgb(198,53,216)",
              "rgb(43,224,215)",
              "rgb(32,17,65)",
              "rgb(26,207,98)",
              "rgb(175,93,205)",
              "rgb(229,179,196)",
              "rgb(190,98,188)",
              "rgb(102,128,173)",
              "rgb(119,175,118)",
              "rgb(110,203,253)",
              "rgb(81,20,63)",
              "rgb(56,24,175)",
              "rgb(153,205,155)",
              "rgb(44,140,8)",
              "rgb(225,90,157)",
              "rgb(58,179,69)",
              "rgb(51,21,233)",
              "rgb(128,95,254)",
              "rgb(64,15,27)",
              "rgb(26,183,69)",
              "rgb(79,238,96)",
              "rgb(44,73,124)",
              "rgb(5,236,244)",
              "rgb(27,6,150)",
              "rgb(127,252,159)",
              "rgb(216,70,137)",
              "rgb(223,140,182)",
              "rgb(137,137,148)",
              "rgb(123,9,96)",
              "rgb(109,50,222)",
              "rgb(201,45,119)",
              "rgb(190,53,165)",
              "rgb(149,24,239)",
              "rgb(57,75,43)",
              "rgb(157,109,234)",
              "rgb(60,243,23)",
              "rgb(140,80,151)",
              "rgb(104,35,97)",
              "rgb(250,84,90)",
              "rgb(15,197,5)",
              "rgb(53,128,4)",
              "rgb(215,200,170)",
              "rgb(168,253,26)",
              "rgb(131,244,42)",
              "rgb(242,112,102)",
              "rgb(162,205,134)",
              "rgb(113,85,71)",
              "rgb(25,212,73)",
              "rgb(194,208,181)",
              "rgb(154,168,155)",
              "rgb(214,59,34)",
              "rgb(178,70,204)"
            ]
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
  },
  computed: {
    ...mapGetters({
      products: 'product/products',
      product: 'product/product',
      chartProduct: 'product/chartProduct',
      activationLines: 'activation/activationLines'
    })
  },
  watch: {
    chartProduct() {
      this.chartData.labels = this.chartProduct
    },
    activationLines() {
      var obj = [];

      for (var p of this.products) {
        var i = 0;
        for (var s of this.activationLines) {
          if (p.id == s.product_id) {
            i++;
          }
        }
        obj = [...obj, i];
      }
      this.chartData.datasets[0].data = obj;
      console.log(obj);
    }
  },
  mounted() {
    this.$store.dispatch('product/GET_PRODUCT').then(response => {
      if (response) {
        this.chartData.labels = this.chartProduct
      }
    })
    this.$store.dispatch('activation/GET_ACTIVATION_LINE').then(response => {
      if (response) {
        var obj = [];
        for (var p of this.products) {
          var i = 0;
          for (var s of this.activationLines) {
            if (p.id == s.product_id) {
              i++;
            }
          }
          obj = [...obj, i];
        }
        this.chartData.datasets[0].data = obj;
      }
    })

  },
  methods: {
    // GENERATE COLOR CODE
    getColorCode() {
      var colorCode = []
      var dynamicColors = function () {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
      };
      for (var i = 0; i <= 100; i++) {
        colorCode.push(dynamicColors());
      }
      this.chartData.datasets[0].backgroundColor = colorCode;
      this.chartData.datasets[0].hoverBackgroundColor = colorCode;
    }
  }
}
</script>