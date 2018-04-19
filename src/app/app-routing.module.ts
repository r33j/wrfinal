import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';
import { HomePageComponent } from './home-page/home-page.component';
import { ChartsComponent } from './charts/charts.component';

const routes: Routes = [
  { path: '', redirectTo: '/home-page', pathMatch: 'full'},
  { path: 'home-page', component: HomePageComponent },
  { path: 'charts/:pseudo', component: ChartsComponent },
];

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot(routes),
  ],
  exports: [RouterModule],
  declarations: []
})
export class AppRoutingModule { }
