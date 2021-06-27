import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {AppArticlesComponent} from "./app-articles/app-articles.component";
import {AppArticleComponent} from "./app-article/app-article.component";

const routes: Routes = [
  {
    path: '',
    component: AppArticlesComponent
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
