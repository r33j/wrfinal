import { Component, OnInit, Input } from '@angular/core';
import { DataService, Champion, Summoner, MatchSummoner, SummonerInMatch } from '../data.service';
import { Chart } from 'chart.js';
import { ChartsModule } from 'ng2-charts';

@Component({
  selector: 'app-board',
  templateUrl: './board.component.html',
  styleUrls: ['./board.component.scss']
})
export class BoardComponent implements OnInit {
  @Input() public pseudo: string;
  public boardData:Array<any> = [];
  public boardLabels:Array<any> = ['Game Type', 'Champion', 'Kills', 'Deaths', 'Assists', 'Win'];
  public lineChartOptions:any = {
    responsive: true
  };
  constructor(private data: DataService) { }

  ngOnInit() {

      this.data.Summoner(this.pseudo)
          .subscribe((res: Summoner) => {
              for(let value of res.summoner_in_matchs.slice(0, 20)){
                  let data:Array<any> = [];
                  data.push(value.match_summoner.game_type);
                  if (value.champion.name == null){
                    data.push("No Champion");
                  } else {
                    data.push("http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/"+value.champion.name+".png");
                  }
                  data.push(value.kills);
                  data.push(value.deaths);
                  data.push(value.assists);
                  if (value.win){
                    data.push("WIN");
                  } else {
                    data.push("LOST");
                  }
                  this.boardData.push(data);
              }
          })
    };
}
