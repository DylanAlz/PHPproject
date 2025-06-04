@extends('layouts.app')

@section('content')

    <section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5">Movies</h2>
    <div class="row g-4">

      <!-- Película 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/img/spiderman.jpeg') }}" class="card-img-top" alt="Spider-Man: Across the Spider-Verse">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Spider-Man: Across the Spider-Verse</h5>
            <p class="card-text text-muted mb-1">Action | Rating: Suitable for all audiences | Duration: 2h 20min</p>
            <p class="card-text flex-grow-1">Miles Morales returns in a multiversal adventure that exceeds all expectations. In this second installment, he reunites with Gwen Stacy and travels through multiple dimensions where he meets a team of Spider-People tasked with protecting the very existence of the multiverse. With groundbreaking animation and a deeply emotional narrative, the film delivers a unique experience that blends thrilling action, humor, and a powerful message about identity, responsibility, and belonging.</p>
            <div class="mt-3">
              <p class="mb-1"><strong>Schedules:</strong></p>
              <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-primary">2:00 PM</span>
                <span class="badge bg-primary">4:30 PM</span>
                <span class="badge bg-primary">7:00 PM</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Película 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/img/oppenheimer.jpg') }}" class="card-img-top" alt="Oppenheimer">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Oppenheimer</h5>
            <p class="card-text text-muted mb-1">Drama, History, Thriller | Rating: +14 | Duration: 3h 00min</p>
            <p class="card-text flex-grow-1">Directed by Christopher Nolan, Oppenheimer is an intense biographical film about J. Robert Oppenheimer, the theoretical physicist who led the Manhattan Project during World War II. The film delves into the ethical, scientific, and personal dilemmas behind the creation of the atomic bomb, showing the internal struggles of the protagonist as the world changes forever. Through a fragmented and visually powerful narrative, Nolan weaves a story that blends science, politics, and human drama with relentless precision.</p>
            <div class="mt-3">
              <p class="mb-1"><strong>Schedules:</strong></p>
              <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-primary">12:30 PM</span>
                <span class="badge bg-primary">3:00 PM</span>
                <span class="badge bg-primary">5:45 PM</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Película 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/img/dunes.jpeg') }}" class="card-img-top" alt="Dune: Part Two">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Dune: Part Two</h5>
            <p class="card-text text-muted mb-1">Drama, History, Thriller | Rating: +12 | Duration: 2h 46min</p>
            <p class="card-text flex-grow-1">In this highly anticipated sequel to Dune, Paul Atreides joins the Fremen of planet Arrakis to claim his destiny and confront the forces that destroyed his family. With an even more epic and emotional approach, the film explores the bond between Paul and Chani as the conflict intensifies over control of the universe’s most valuable resource: the spice. Denis Villeneuve elevates the narrative with visually stunning scenes, massive battles, and deep reflections on power, religion, and destiny.</p>
            <div class="mt-3">
              <p class="mb-1"><strong>Schedules:</strong></p>
              <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-primary">10:00 AM</span>
                <span class="badge bg-primary">12:15 PM</span>
                <span class="badge bg-primary">2:30 PM</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


@endsection
