<script>
import { defineComponent } from 'vue'
import { Line } from 'vue3-chart-v2'

export default defineComponent({
  name: 'LineChart',
  extends: Line,
  props:{
    ChartData:{
      type: Object,
      required : true
    },
    ChartOptions:{
      type: Object,
      required: true
    },
    Update:{
      type: Number
    }
  },
  mounted () {
    // Overwriting base render method with actual data.
    this.renderChart(this.ChartData, this.ChartOptions)
  },
  watch:{
    Update:{
      handle: function(){
        this._Chart.destroy();
        this.renderChart(this.ChartData, this.ChartOptions);
      }
    }
  }
});
</script>