import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {AppArticlesComponent} from "./app-articles/app-articles.component";
import {AppArticleComponent} from "./app-article/app-article.component";
import {AppRegisterComponent} from "./app-register/app-register.component";

const routes: Routes = [
  {
    path: '',
    component: AppArticlesComponent
  },
  {
    path: 'register',
    component: AppRegisterComponent
  },
  {
    path: ':article',
    component: AppArticleComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
