import { Component, OnInit, Input } from '@angular/core';
import { DataService, SummonerInMatch, Summoner  } from '../data.service';
import { Chart } from 'chart.js';
import { ChartsModule } from 'ng2-charts';

@Component({
    selector: 'app-radarchart',
    templateUrl: './radarchart.component.html',
    styleUrls: ['./radarchart.component.scss']
})
export class RadarchartComponent implements OnInit {
    @Input() public pseudo: string;

    public radarChartLabels:string[] = ['TOP', 'jungle', 'Carry AP', 'Support', 'Carry AD'];

    public radarChartData:any = [

        {data: [], label: 'Winrate '},
    ];
    public radarChartType:string = 'radar';

    // events
    public chartClicked(e:any):void {
        console.log(e);
    }

    public chartHovered(e:any):void {
        console.log(e);
    }

    constructor(private data : DataService) { }

    ngOnInit() {
        this.data.Summoner(this.pseudo)
            .subscribe((res: Summoner) => {
                console.log(res.summoner_in_matchs);

                let ratio: Array<number> = [];


                let top: number = 0;
                let jungle: number = 0;
                let carry_ap: number = 0;
                let support: number = 0;
                let carry_ad: number = 0;
                let top_total: number = 0;
                let jungle_total: number = 0;
                let carry_ap_total: number = 0;
                let support_total: number = 0;
                let carry_ad_total: number = 0;


                for(let values of res.summoner_in_matchs) {
                    if(values.role == "SOLO" || values.lane == "TOP"){
                        top_total++;

                        if (values.win == true){
                            top++;
                        }
                    }

                    if( values.role == "SOLO" || values.lane == "JUNGLE"){
                        jungle_total++;

                        if(values.win == true){
                            jungle++;
                        }

                    }

                    if( values.role == "SOLO" || values.lane == "MID") {
                        carry_ap_total++;

                        if( values.win == true) {
                            carry_ap++;
                        }
                    }
                    if(values.role == "DUO_SUPPORT" && values.lane == "BOTTOM") {
                        support_total++;

                        if(values.win == true){
                            support_total++
                        }
                    }

                    if(values.role == "DUO_CARRY" && values.lane == "BOTTOM") {
                        carry_ad_total++;

                        if(values.win == true)
                            carry_ad++
                    }
                }

                ratio.push(top/top_total*100);
                ratio.push(jungle/jungle_total*100);
                ratio.push(carry_ap/carry_ap_total*100);
                ratio.push(support/support_total*100);
                ratio.push(carry_ad/carry_ad_total*100);

                this.radarChartData = [
                    {data: ratio, label: 'Winrate '}

                ];

            })
    };
}
