import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PseudoComponent } from './pseudo-form.component';

describe('PseudoFormComponent', () => {
  let component: PseudoFormComponent;
  let fixture: ComponentFixture<PseudoFormComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PseudoFormComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PseudoFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
