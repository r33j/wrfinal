import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { ChartsModule } from 'ng2-charts';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { ParticlesModule } from 'angular-particle';
import { DataService } from './data.service';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavBarComponent } from './nav-bar/nav-bar.component';
import { HomePageComponent } from './home-page/home-page.component';
import { FooterComponent } from './footer/footer.component';
import { LoginComponent } from './login/login.component';
import { ChartsComponent } from './charts/charts.component';
import { RadarchartComponent } from './radarchart/radarchart.component';
import { LinechartComponent } from './linechart/linechart.component';
import { PseudoFormComponent } from './pseudo-form/pseudo-form.component';
import { BoardComponent } from './board/board.component';


@NgModule({
  declarations: [
    AppComponent,
    NavBarComponent,
    HomePageComponent,
    FooterComponent,
    LoginComponent,
    ChartsComponent,
    RadarchartComponent,
    LinechartComponent,
    PseudoFormComponent,
    BoardComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpModule,
    ReactiveFormsModule,
    HttpClientModule,
    ChartsModule,
      ParticlesModule
  ],
  providers: [
      DataService,
    ],
  bootstrap: [AppComponent]
})
export class AppModule { }
