<style>
.countersection {
    position: relative; /* Set position relative */
    background-image: url(../image/backimage1.jpg);
    background-position: center;
    background-attachment: fixed;
    background-size: cover; /* Cover the whole area */
    z-index: 1;
    height: 70vh; /* Adjust height as needed */
}

.countersection::before {
    content: " ";
    display: block;
    background: rgba(0, 0, 0, 0.3); /* Semi-transparent black */
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height:70vh; 
    z-index: 0; 
}




.counters { 
    background-color: #ffffff; 
    position: relative;
    border-radius: 5px; 
  
}
.countersection {
    background-color: #f8f9fa; 
    padding: 50px 0; 
}

.counters {
    background-color: #ffffff; 
    padding: 20px;
    border-radius: 10px; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
    text-align: center; 
    transition: transform 0.3s;
}

.counters:hover {
    transform: scale(1.05); 
}


.count-text {
    font-size: 16px; 
    color: #666; 
    margin: 5px 0;
}

.forcountericons {
    color:var(--off-yellow);
    margin-bottom: 10px;
    font-size: 32px;
}
@media (max-width: 768px) {
    .counters {
        margin-bottom: 20px; 
    }



    .countersection {
    position: relative; /* Set position relative */
    background-image: url(../image/backimage1.jpg);
    background-position: center;
    background-attachment: fixed;
    background-size: cover; /* Cover the whole area */
    z-index: 1;
    height:86vh; 
  
}

.countersection::before {
    height:86vh; 
  
}

}

</style>




<section class="container-fluid countersection m-0 p-0">
  <div class="container d-flex flex-column justify-content-between pt-md-5">
  <div class="title text-center py-4">
      <div class="xs-text dashline ">Trusted Reassl estate Care</div>
      <div class="lg-text1 ">Our Success Stories</div>
    </div>
    <div class="row m-0 p-0 gap-md-3 gap-1 d-flex justify-content-center mt-3">
    <div class="counters col-md-2 col-5">
      <i class="fa-solid fa-circle-check forcountericons"></i>
      <h2 class="timer count-title count-number" data-to="700" data-speed="5000"></h2>
       <p class="count-text md-text">available</p>
    </div>

    <div class="counters col-md-2 col-5">
      <i class="fa-brands fa-sellcast forcountericons"></i>
      <h2 class="timer count-title count-number" data-to="900" data-speed="5000"></h2>
       <p class="count-text md-text">sell</p>
    </div>
    <div class="counters col-md-2 col-5">
      <i class="fa-solid fa-truck-ramp-box forcountericons"></i>
      <h2 class="timer count-title count-number" data-to="8800" data-speed="5000"></h2>
       <p class="count-text md-text">Rent</p>
    </div>
    <div class="counters col-md-2 col-5">
      <i class="fa-brands fa-sellsy forcountericons"></i>
      <h2 class="timer count-title count-number" data-to="99900" data-speed="5000"></h2>
       <p class="count-text md-text">Total</p>
    </div>
  


    </div>
  </div>

</section>
<script>
(function ($) {
    $.fn.countTo = function (options) {
        options = options || {};
        
        return $(this).each(function () {
            var settings = $.extend({}, $.fn.countTo.defaults, {
                from: $(this).data('from') || 0,
                to: $(this).data('to'),
                speed: $(this).data('speed'),
                refreshInterval: $(this).data('refresh-interval'),
                decimals: $(this).data('decimals')
            }, options);
            
            var loops = Math.ceil(settings.speed / settings.refreshInterval),
                increment = (settings.to - settings.from) / loops;
            
            var self = this,
                $self = $(this),
                loopCount = 0,
                value = settings.from,
                data = $self.data('countTo') || {};
            
            $self.data('countTo', data);
            
            if (data.interval) {
                clearInterval(data.interval);
            }

            function updateTimer() {
                value += increment;
                loopCount++;
                
                render(value);
                
                if (typeof(settings.onUpdate) == 'function') {
                    settings.onUpdate.call(self, value);
                }
                
                if (loopCount >= loops) {
                    $self.removeData('countTo');
                    clearInterval(data.interval);
                    value = settings.to;
                    
                    if (typeof(settings.onComplete) == 'function') {
                        settings.onComplete.call(self, value);
                    }
                }
            }
            
            function render(value) {
                var formattedValue = settings.formatter.call(self, value, settings);
                $self.html(formattedValue);
            }

            // Start the counting process
            data.interval = setInterval(updateTimer, settings.refreshInterval);
            render(value); // Initial render
        });
    };

    $.fn.countTo.defaults = {
        from: 0,
        to: 0,
        speed: 1000,
        refreshInterval: 100,
        decimals: 0,
        formatter: function(value, settings) {
            return value.toFixed(settings.decimals);
        },
        onUpdate: null,
        onComplete: null
    };
}(jQuery));

jQuery(function ($) {
    var counted = false; // Track if counting has started

    // Custom formatting example
    $('.count-number').data('countToOptions', {
        formatter: function (value, options) {
            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
    });

    // Function to start counting
    function startCounting() {
        $('.timer').each(function () {
            var $this = $(this);
            $this.countTo($this.data('countToOptions'));
        });
    }

    // Set up Intersection Observer
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !counted) {
                counted = true; // Prevent multiple counts
                startCounting();
            }
        });
    }, {
        threshold: 0.1 // Trigger when 10% of the counter section is visible
    });

    // Observe the counter section
    var counterSection = document.querySelector('.countersection');
    if (counterSection) {
        observer.observe(counterSection);
    }
});
</script>


