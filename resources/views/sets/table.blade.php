<x-app-layout>
    <x-section>
        <x-table-simple

        :columns='[
          [
            "name" => "Name",
            "field" => "name",
            "columnClasses" => "", // classes to style table th
            "rowClasses" => "" // classes to style table td
          ],
          [
            "name" => "Email",
            "field" => "email",
            "columnClasses" => "",
            "rowClasses" => ""
          ]
        ]'

        :rows='[
          [
            "name" => "Thor",
            "email" => "thor@test.test"
          ],
          [
            "name" => "Loki",
            "email" => "loki@test.test"
          ],
          [
            "name" => "Loki",
            "email" => "loki@test.test"
          ]
        ]'

      />



        
    </x-section>
</x-app-layout>

