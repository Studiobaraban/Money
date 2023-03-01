<template>
    <div id="chart" class="w-full overflow-hidden p-0 m-0">
        <div class="absolute p-5 z-50">
            <div>{{ legend.ema }}</div>
        </div>
        <!-- <div v-if="!candles || candles.length == 0" class="w-full overflow-hidden flex justify-center items-center">
            <svg
                role="status"
                class="mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-cyan-500"
                viewBox="0 0 100 101"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor"
                ></path>
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill"
                ></path>
            </svg>
        </div> -->
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import { createChart } from "lightweight-charts";
import moment from "moment";

export default {
    name: "InOutGraf",

    data() {
        return {
            chart: "",
            legend: [],
            grafData: [],
            h: 300,
        };
    },

    computed: {
        ...mapGetters(["transactions"]),
    },

    watch: {
        // при каждом изменении candles эта функция будет запускаться
        transactions(newValue) {
            if (newValue) {
                this.baseline();
            }
        },
    },

    methods: {
        baseline() {
            let value = 0;
            let str = this.transactions[this.transactions.length - 1].create_at;
            str = moment(str).format("YYYY-MM-DD");
            let end = this.transactions[0].create_at;
            end = moment(end).format("YYYY-MM-DD");

            // console.log("date", str, end);

            while (str <= end) {
                value =
                    value +
                    this.transactions.reduce((acc, item) => {
                        if (moment(item.create_at).format("YYYY-MM-DD") == str) {
                            acc = acc + parseFloat(item.sum);
                        }
                        return acc;
                    }, 0);
                this.grafData.push({ time: str, value: value });

                str = moment(str).add(1, "days").format("YYYY-MM-DD");
            }

            // console.log("grafData", this.grafData);

            this.baselineSeries.setData(this.grafData);

            this.chart.subscribeCrosshairMove((param) => {
                this.setLegend(param.seriesPrices.get(this.baselineSeries), 0, 0);
            });
        },

        showGraf() {
            this.chart = createChart(document.getElementById("chart"), {
                timeScale: {
                    timeVisible: true,
                    borderColor: "#eee",
                },
                rightPriceScale: {
                    borderColor: "#eee",
                },
                layout: {
                    backgroundColor: "#fff",
                    textColor: "#000",
                },
                grid: {
                    horzLines: { color: "#eee" },
                    vertLines: { color: "#eee" },
                },
            });
            this.chart.applyOptions({ height: this.h, width: this.w });
            this.baselineSeries = this.chart.addBaselineSeries({
                baseValue: { type: "price", price: 0 },
                topLineColor: "rgba( 38, 166, 154, 1)",
                topFillColor1: "rgba( 38, 166, 154, 0.28)",
                topFillColor2: "rgba( 38, 166, 154, 0.05)",
                bottomLineColor: "rgba( 239, 83, 80, 1)",
                bottomFillColor1: "rgba( 239, 83, 80, 0.05)",
                bottomFillColor2: "rgba( 239, 83, 80, 0.28)",
            });

            this.chart.timeScale().fitContent();
        },

        setLegend(ema, top, btm) {
            this.legend.ema = ema;
            this.legend.top = top;
            this.legend.btm = btm;
        },

        resizeChart(e) {
            this.h = e.target.innerHeight - 300;
            this.w = e.target.innerWidth - 500;
            this.chart.applyOptions({ height: this.h, width: this.w });
        },
    },

    mounted() {
        this.showGraf();
        window.addEventListener("resize", this.resizeChart);
    },
};
</script>

<style scoped>
.tv-lightweight-charts,
.tv-lightweight-charts table {
    width: 100% !important;
    height: 100% !important;
}
</style>
