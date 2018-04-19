import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-pseudo-form',
  templateUrl: './pseudo-form.component.html',
  styleUrls: ['./pseudo-form.component.scss']
})
export class PseudoFormComponent implements OnInit {

  pseudoForm: FormGroup;
  titleAlert:string = 'Pseudo is required';




  constructor(
    private fb: FormBuilder,
    private router: Router,
  ) {
      this.pseudoForm = fb.group({
        'pseudo': [null, Validators.required],
      });
   }


 ngOnInit() {

 }


  setPseudo() {
   const pseudo = this.pseudoForm.value.pseudo;

   this.router.navigate(['charts', pseudo]);
 }

}
