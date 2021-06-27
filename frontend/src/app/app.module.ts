import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {AppArticlesComponent} from "./app-articles/app-articles.component";
import {ArticleService} from "./service/article.service";
import {HttpClientModule} from "@angular/common/http";
import {AppArticleComponent} from "./app-article/app-article.component";
import {FormsModule} from "@angular/forms";

@NgModule({
  declarations: [
    AppComponent,
    AppArticleComponent,
    AppArticlesComponent
  ],
  imports: [
    AppRoutingModule,
    BrowserModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [
    ArticleService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
